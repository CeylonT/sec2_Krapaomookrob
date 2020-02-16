<?php

use Illuminate\Database\Seeder;
use App\Course;
use App\Day;
use App\Subject;

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

          $course = Course::create([
            'area' => 'Siamparagon',
            'time' => '12:00:00',
            'hours' => '2',
            'startDate' => '2020-02-04',
            'studentCount' => 3,
            'price' => 500,
            'noClasses' => '4',
            'user_id' => 4
          ]);

          $someDays = Day::find([1,2,3]);
          $someSubjects = Subject::find([1,2,3]);

          $course->days()->attach($someDays);
          $course->subjects()->attach($someSubjects);

          $course2 = Course::create([
            'area' => 'Silom',
            'time' => '14:00:00',
            'hours' => '2',
            'startDate' => '2020-02-04',
            'studentCount' => 1,
            'price' => 1000,
            'noClasses' => '10',
            'user_id' => 5
          ]);

          $someDays2 = Day::find([2,4]);
          $someSubjects2 = Subject::find([1,2,3]);
          
          $course2->days()->attach($someDays2);
          $course2->subjects()->attach($someSubjects2);
          
          $course3 = Course::create([
            'area' => 'Chulalogkorn',
            'time' => '13:00:00',
            'hours' => '1',
            'startDate' => '2020-02-17',
            'studentCount' => 2,
            'price' => 700,
            'noClasses' => '12',
            'user_id' => 6
          ]);

          $someDays3 = Day::find([1,2,4,5]);
          $someSubjects3 = Subject::find([1,2,3,4]);
          
          $course3->days()->attach($someDays3);
          $course3->subjects()->attach($someSubjects3);
          
          $course4 = Course::create([
            'area' => 'Samyan Mitr Town',
            'time' => '9:00:00',
            'hours' => '2',
            'startDate' => '2020-03-01',
            'studentCount' => 1,
            'price' => 750,
            'noClasses' => '1',
            'user_id' => 6
          ]);

          $someDays4 = Day::find([1,7]);
          $someSubjects4 = Subject::find([1,8,11]);
          
          $course4->days()->attach($someDays4);
          $course4->subjects()->attach($someSubjects4);
      

    }
}
