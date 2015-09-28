<?php namespace Calculator;


class Validator
{
    public function isStartDateValid(\DateTime $date)
    {
        $weekDay = $date->format('l');

        if ($this->_isStartTimeValid($date) && $weekDay != 'Saturday' && $weekDay != 'Sunday')
        {
            return true;
        }

        return false;
    }

    private function _isStartTimeValid(\DateTime $date)
    {
        $baseDate = $date->format('Y-m-d');
        $from     = new \DateTime($baseDate . " 9:00");
        $to       = new \DateTime($baseDate . " 17:00");
        $startTimestamp = $date->getTimestamp();

        if ($from->getTimestamp() <= $startTimestamp && $to->getTimestamp() >= $startTimestamp)
        {
            return true;
        }

        return false;
    }

    public function isHourValid($hour)
    {
        if (!is_numeric($hour) || is_double($hour) || $hour < 0)
        {
            return false;
        }

        return true;
    }

}