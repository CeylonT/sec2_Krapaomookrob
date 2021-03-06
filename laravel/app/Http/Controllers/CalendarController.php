<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;
use App\User;
use App\CourseRequester;
use Illuminate\Support\Facades\Log;

class CalendarController extends Controller
{
    public function getMyClasses(){
      $user = Auth::user();
      $colors = ['blue', 'indigo', 'deep-purple', 'cyan', 'green', 'orange', 'grey darken-1'];
      $result = collect();
      $classes = collect();
      if($user->isTutor()){
        $classes = DB::select('select classes.id as clid,courses.id as coid,classes.date,classes.time,classes.hours,users.nickname,locations.name as location,classes.status from course_classes classes
                                inner join courses on classes.course_id = courses.id
                                inner join course_student student on courses.id = student.course_id
                                inner join locations on locations.id = courses.location_id
                                left join users on student.user_id = users.id
                                where courses.user_id = ? and student.status = ?', [$user->id, 'registered']);

      $classes2 = DB::select('select classes.id as clid,courses.id as coid,classes.date,classes.time,classes.hours,users.nickname,locations.name as location,classes.status from course_classes classes
                              inner join courses on classes.course_id = courses.id
                              inner join course_student student on courses.id = student.course_id
                              inner join locations on locations.id = courses.location_id
                              inner join course_requesters on courses.id = course_requesters.course_id
                              left join users on student.user_id = users.id
                              where course_requesters.requester_id = ? and student.status = ? and course_requesters.status = ?', [$user->id, 'registered', 'Accepted']);
      $classes = collect($classes)->concat(collect($classes2));

        foreach($classes as $class){
          $nTime = Carbon::parse("{$class->date} {$class->time}")->addHour($class->hours);
          $nn = $class->nickname;
          $temp = collect([
            'class_id' => $class->clid,
            'course_id' => $class->coid,
            'name' => "P'{$nn}",
            'start' => "{$class->date} {$class->time}",
            'end' => $nTime->toDateTimeString(),
            'color' => $colors[$class->coid%7],

            // for display in calendar's card
            'time' => date_format(date_create($class->time), 'H:i') . ' - ' . date_format(date_create($nTime), 'H:i'),
            'location' => $class->location,
            'postponable' => !($class->status==='Postponed' || $class->date < date("Y-m-d"))
          ]);
          $result->push($temp);
        }
      }else{
        $classes = DB::select('select classes.id as clid,courses.id as coid,courses.user_id as couid,classes.date,classes.time,classes.hours,users.nickname,locations.name as location,classes.status from course_classes classes
                                inner join courses on classes.course_id = courses.id
                                inner join course_student student on courses.id = student.course_id
                                inner join locations on locations.id = courses.location_id
                                left join users on courses.user_id = users.id
                                where student.user_id = ? and student.status = ?', [$user->id, 'registered']);
        foreach($classes as $class){
          $nTime = Carbon::parse("{$class->date} {$class->time}")->addHour($class->hours);

          $nn = $class->nickname;
          if($this->isMadeByStudent($class->couid)){
              $nn = $this->getTutorName($class->coid);
          }

          $temp = collect([
            'class_id' => $class->clid,
            'course_id' => $class->coid,
            'name' => "P'{$nn}",
            'start' => "{$class->date} {$class->time}",
            'end' => $nTime->toDateTimeString(),
            'color' => $colors[$class->coid%7],

            // for display in calendar's card
            'time' => date_format(date_create($class->time), 'H:i') . ' - ' . date_format(date_create($nTime), 'H:i'),
            'location' => $class->location,
            'postponable' => !($class->status==='Postponed' || $class->date <= date("Y-m-d"))
          ]);
          $result->push($temp);
        }
      }
      return response()->json($result->toArray());
    }

    public function isMadeByStudent($uid){
        $userRole = User::find($uid)->role;
        return $userRole == 'student';
    }

    public function getTutorName($coid){
        $realUserId = CourseRequester::where('course_id','=',$coid)->where('status','=','Accepted')->get()->first()->requester_id;
        return User::find($realUserId)->nickname;
    }

}
