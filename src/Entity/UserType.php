<?php

namespace App\Entity;

use App\Entity\BasicEnum;

class UserType extends BasicEnum
{   
    const TYPE_HOSPITAL= 'trainingManager';
    const TYPE_PATIENT= 'companyManager';
    const TYPE_DOCTOR= 'userIT';
    const TYPE_ADMIN= 'admin';
    


}