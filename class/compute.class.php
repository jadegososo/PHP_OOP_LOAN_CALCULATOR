<?php

class Compute {
    // Properties
    private $terms = [
        ['term' => 12, 'value' => 0],
        ['term' => 18, 'value' => 0],
        ['term' => 24, 'value' => 0],
        ['term' => 30, 'value' => 0],
        ['term' => 36, 'value' => 0],
    ];

    private $interest = 0.005; // Monthly add-on rate of 0.5%
    
    // Methods
    public function __construct(private $loan_amount = 0) {}

    public function computeInstallments() {
        foreach ($this->terms as $key => $term) {
            // Total interest over the term
            $total_addon = $this->loan_amount * $this->interest * $term['term'];
            
            // Monthly installment is the sum of the loan amount divided by the term + total interest divided by the term
            $monthly = ($this->loan_amount + $total_addon) / $term['term'];

            $this->terms[$key]['value'] = round($monthly, 2); // Rounded to two decimal places
        }
    }

    public function getLoanDetails() {
        return $this->terms;
    }
}
