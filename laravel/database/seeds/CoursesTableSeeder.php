<?php

use Illuminate\Database\Seeder;
use App\Course;
use App\Day;
use App\Subject;
use App\Location;
use App\User;
use App\Http\Controllers\CourseController;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
          foreach($days as $day){
              Day::create([
                'name' => $day,
              ]);
          }
          $subjects = ['Mathematics', 'Economic', 'History', 'Technology', 'Science', 'Biology', 'Chemical', 'English', 'Thai', 'Geography', 'Physics', 'Music'];
          foreach($subjects as $subject){
              Subject::create([
                'name' => $subject,
              ]);
          }

          $location = Location::create([
            'name' => 'จุฬาลงกรณ์มหาวิทยาลัย',
            'address' => '254 ถนน พญาไท แขวง วังใหม่ เขตปทุมวัน กรุงเทพมหานคร 10330 ประเทศไทย',
            'latitude' => 13.7384627,
            'longitude' => 100.5320458,
            'locationId' => '5a14febeeeafb68572c007e2fc69ea6f2a609651'
          ]);

          $course = Course::create([
            'time' => '12:00:00',
            'hours' => '2',
            'startDate' => '2021-02-04',
            'studentCount' => 3,
            'price' => 500,
            'noClasses' => '5',
            'user_id' => 1,
            'location_id' => 1
          ]);

          $someDays = Day::find([1,2,3]);
          $someSubjects = Subject::find([1,2,3]);

          $course->days()->attach($someDays);
          $course->subjects()->attach($someSubjects);
          CourseController::newClasses($course);

          $course2 = Course::create([
            'time' => '14:00:00',
            'hours' => '2',
            'startDate' => '2021-02-04',
            'studentCount' => 1,
            'price' => 1000,
            'noClasses' => '4',
            'user_id' => 1,
            'location_id' => 1
          ]);

          $someDays2 = Day::find([2,4]);
          $someSubjects2 = Subject::find([1,2,3]);

          $course2->days()->attach($someDays2);
          $course2->subjects()->attach($someSubjects2);
          CourseController::newClasses($course2);


          $course3 = Course::create([
            'time' => '13:00:00',
            'hours' => '1',
            'startDate' => '2021-02-17',
            'studentCount' => 2,
            'price' => 700,
            'noClasses' => '12',
            'user_id' => 6,
            'location_id' => 1
          ]);

          $someDays3 = Day::find([1,2,4,5]);
          $someSubjects3 = Subject::find([1,2,3,4]);

          $course3->days()->attach($someDays3);
          $course3->subjects()->attach($someSubjects3);
          CourseController::newClasses($course3);

          $course4 = Course::create([
            'time' => '9:00:00',
            'hours' => '2',
            'startDate' => '2021-03-01',
            'studentCount' => 1,
            'price' => 750,
            'noClasses' => '1',
            'user_id' => 6,
            'location_id' => 1
          ]);

          $someDays4 = Day::find([1,7]);
          $someSubjects4 = Subject::find([1,8,11]);

          $course4->days()->attach($someDays4);
          $course4->subjects()->attach($someSubjects4);
          CourseController::newClasses($course4);

          for($i = 1; $i <= 27; $i++){
            $courseI = Course::create([
              'time' => '14:00:00',
              'hours' => '2',
              'startDate' => '2020-03-'.$i,
              'studentCount' => 3,
              'price' => 1000*($i%3) + ($i%13)*100,
              'noClasses' => $i,
              'user_id' => $i%2==0?5:6,
              'location_id' => 1
            ]);

            $someDaysI = $courseI->days()->attach(Day::find([$i%8, ($i+1)%8, ($i+2)%8]));
            $someSubjectsI = $courseI->subjects()->attach(Subject::find([$i%13, $i%3, $i%5]));

            $courseI->days()->attach($someDaysI);
            $courseI->subjects()->attach($someSubjectsI);

            $courseI->students()->attach(User::find($i % 6 + 1));
            CourseController::newClasses($courseI);
          }



          $course3 = Course::create([
            'time' => '13:00:00',
            'hours' => '1',
            'startDate' => '2021-02-17',
            'studentCount' => 2,
            'price' => 700,
            'noClasses' => '12',
            'user_id' => 6,
            'location_id' => 1
          ]);

          $someDays3 = Day::find([1,2,4,5]);
          $someSubjects3 = Subject::find([1,2,3,4]);

          $course3->days()->attach($someDays3);
          $course3->subjects()->attach($someSubjects3);
          CourseController::newClasses($course3);

          $course4 = Course::create([
            'time' => '9:00:00',
            'hours' => '2',
            'startDate' => '2021-03-01',
            'studentCount' => 1,
            'price' => 750,
            'noClasses' => '1',
            'user_id' => 6,
            'location_id' => 1
          ]);

          $someDays4 = Day::find([1,7]);
          $someSubjects4 = Subject::find([1,8,11]);

          $course4->days()->attach($someDays4);
          $course4->subjects()->attach($someSubjects4);
          CourseController::newClasses($course4);
    }
}
