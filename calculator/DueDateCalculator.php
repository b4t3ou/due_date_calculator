<?php namespace Calculator;


class DueDateCalculator
{
    private $_validator;

    public function __construct(Validator $validator)
    {
        $this->_validator = $validator;
    }

    public function getDueDate(\DateTime $startDate, $hours)
    {
        if (!$this->_validator->isStartDateValid($startDate))
        {
            return 'Start date not valid!';
        }

        if (!$this->_validator->isHourValid($hours))
        {
            return 'Hour not valid!';
        }

        return $this->calculate($startDate, $hours * 60 * 60);
    }

    private function calculate(\DateTime $start, $seconds)
    {
        $baseDate = $start->format('Y-m-d');
        $to       = new \DateTime($baseDate . " 17:00");
        $diff     = $to->getTimestamp() - $start->getTimestamp();

        if ($diff > $seconds)
        {
            $dueDate = $start->getTimestamp() + $seconds;

            return date('Y-m-d H:i', $dueDate);
        }
        else
        {
            $seconds -= ($to->getTimestamp() - $start->getTimestamp());
            $nextDay = $this->getNextValidDay(strtotime('+1 day', $start->getTimestamp()));

            return $this->calculate(new \DateTime($nextDay), $seconds);
        }

    }

    private function getNextValidDay($timestamp)
    {
        $nextDay = date('Y-m-d 9:00', $timestamp);

        if ($this->_validator->isStartDateValid(new \DateTime($nextDay)))
        {
            return $nextDay;
        }

        return $this->getNextValidDay(strtotime('+1 day', strtotime($nextDay)));
    }



}