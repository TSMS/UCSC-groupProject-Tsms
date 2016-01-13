<?php
	class Calculations{
		/*
		[*] $supplied = Supplied tea leaves 
		[*] $rate = Price of 1kg
		[*] $dirrectAddition = Direct additions
		[*] $otherAddition = Other additions
		[*] $lastMonthArrears = Last month arrears
		[*] $loan = Loan
		[*] $advancement = Advancement
		[*] $monthManureInstallment = This month manure installment
		[*] $tea = Tea packets
		[*] $stationaries = Stationaries
		[*] $transportCharge = Transport charge
		[*] $other = Other/scripts
		[*] $stamp = Stamp
		*/

		//This function calculate the monthly income of the supplier
		public function total($suppliedTotal, $dirrectAddition, $otherAddition){
			return ($suppliedTotal + $dirrectAddition + $otherAddition);
		}

		//This function calculate the total price for supplied leaves
		public function calculateSuppliedTotal($supplied, $rate){
			return ($supplied * $rate);
		}

		//This function calculate the monthly total abscissions of supplier
		public function totalAbscissions($lastMonthArrears, $loan, $advancement, $monthManureInstallment, $tea, $stationaries, $transportCharge, $other, $stamp){
			return ($lastMonthArrears + $loan + $advancement + $monthManureInstallment + $tea + $stationaries + $transportCharge + $other + $stamp);
		}

		//This function calculate the balance of the month
		public function balance($total, $totalAbscissions){
			return ($total - $totalAbscissions);
		}
	}
?>