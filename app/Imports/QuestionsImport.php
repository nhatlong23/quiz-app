<?php

namespace App\Imports;

use App\Models\Question;
use App\Models\Level;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuestionsImport implements ToCollection, WithHeadingRow
{
    protected $subject_id;

    public function __construct($subject_id)
    {
        $this->subject_id = $subject_id;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $levelName = $row['level_id'];
            $level = Level::where('name', $levelName)->first();
            $levelId = $level->id;

            $questions = Question::where('question', $row['question'])->first();
            if ($questions) {
                Question::where('question', $row['question'])->update([
                    'subject_id' => $this->subject_id,
                    'level_id' => $levelId,
                    'question' => $row['question'],
                    'option_a' => $row['option_a'],
                    'option_b' => $row['option_b'],
                    'option_c' => $row['option_c'],
                    'option_d' => $row['option_d'],
                    'answer' => $row['answer'],
                    'picture' => $row['picture'],
                    'status' => $row['status'],
                    'updated_at' => now(),
                ]);
            } else {
                Question::create([
                    'subject_id' => $this->subject_id,
                    'level_id' => $levelId,
                    'question' => $row['question'],
                    'option_a' => $row['option_a'],
                    'option_b' => $row['option_b'],
                    'option_c' => $row['option_c'],
                    'option_d' => $row['option_d'],
                    'answer' => $row['answer'],
                    'picture' => $row['picture'],
                    'status' => $row['status'],
                    'created_at' => now(),
                ]);
            }
        }
    }
}
