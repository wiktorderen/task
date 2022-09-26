<?php

namespace App\Controller;

use App\Model\FeeCalculator;
use App\Model\LoanProposal;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ResultController extends AbstractController
{
    private FeeCalculator $feeCalculator;
    private ValidatorInterface $validator;

    public function __construct(FeeCalculator $feeCalculator, ValidatorInterface $validator)
    {
        $this->feeCalculator = $feeCalculator;
        $this->validator = $validator;
    }

    /**
     * @Route("/result", name="app_result")
     */
    public function index(): Response
    {
        $loanAmount = 3000;

        $application = new LoanProposal($loanAmount);

        $validation = $this->validator->validate($application);
        if($validation->count())
        {
            return $this->render('error/index.html.twig');
        }

        $fee = $this->feeCalculator->calculate($application);

        return $this->render('result/index.html.twig', [
            'fee' => $fee,
        ]);
    }
}
