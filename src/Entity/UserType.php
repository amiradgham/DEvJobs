<?php

namespace App\Entity;

use App\Entity\BasicEnum;

class UserType extends BasicEnum
{   
    const TYPE_TRAINIG= 'trainingManager';
    const TYPE_COMPANY= 'companyManager';
    const TYPE_IT= 'userIT';
    const TYPE_ADMIN= 'admin';
    


}