<?php

namespace App\Services\All\Interfaces;

interface AllDataSaveServiceInterface
{
    public function saveAllFirstData($myId);
    public function saveTeamAndPosition($request, $myId);
}