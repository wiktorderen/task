<?php

namespace App\Model;

class FeeCalculator implements \App\FeeCalculator
{
    const A = 0.018252;
    const B = 25.60526;
    const MULTIPLIER = 5;

    public function calculate(LoanProposal $application): float
    {
        return ceil(($application->amount()*self::A+self::B)/self::MULTIPLIER)*self::MULTIPLIER;
    }
}