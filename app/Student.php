<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * 學生
 *
 * @property string stu_id NID
 * @property string stu_name 姓名
 * @property string stu_class 班級
 * @property string unit_name 科系
 * @property string dept_name 學院
 * @property double in_year 入學年度
 * @property string stu_sex 性別
 *
 * @mixin \Eloquent
 */
class Student extends Model
{
    protected $primaryKey = 'stu_id';
    public $incrementing = false;
    protected $fillable = [
        'stu_id',
        'stu_name',
        'stu_class',
        'unit_name',
        'dept_name',
        'in_year',
        'stu_sex',
    ];
}
