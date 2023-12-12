<?php

namespace App\Http\Livewire;

use App\Degree;
use App\Question;
use Livewire\Component;

class ShowQuestion extends Component
{
    public $questioncount=0,$data,$quiz_id,$student_id,$counter=0;

    public function render()
    {
        $this->data = Question::where('quiz_id', $this->quiz_id)->get();
        $this->questioncount = $this->data->count();
        return view('livewire.show-question', ['data']);
    }
    public function nextQuestion($question_id, $score, $answer, $right_answer){
        $stuDegree = Degree::where('student_id', $this->student_id)
            ->where('quiz_id', $this->quiz_id)
            ->first();
        if ($stuDegree == null) {
            $degree = new Degree();
            $degree->quiz_id = $this->quiz_id;
            $degree->student_id = $this->student_id;
            $degree->question_id = $question_id;
            if (strcmp(trim($answer), trim($right_answer)) === 0) {
                $degree->score += $score;
            }else {
                $degree->score += 0;
            }
            $degree->date = date('Y-m-d');
            $degree->save();
        }else{
            if($stuDegree->question_id >= $this->data[$this->counter]->id){
                $stuDegree->score = 0;
                $stuDegree->abuse = '1';
                $stuDegree->save();
                toastr()->error('تم إلغاء الاختبار لإكتشاف تلاعب بالنظام');
                return redirect('student-quizzes');
            }
            else{
                $stuDegree->question_id = $question_id;
                if (strcmp(trim($answer), trim($right_answer)) === 0) {
                    $stuDegree->score += $score;
                } else {
                    $stuDegree->score += 0;
                }
                $stuDegree->save();
            }
        }
        if ($this->counter < $this->questioncount - 1) {
            $this->counter++;
        } else {
            toastr()->success('تم إجراء الاختبار بنجاح');
            return redirect('student-quizzes');
        }

    }

}
