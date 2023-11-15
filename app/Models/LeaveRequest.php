<?php

namespace App\Models;

use EightyNine\Approvals\Models\ApprovableModel;

class LeaveRequest extends ApprovableModel
{
    protected $fillable = ["name"];
}
