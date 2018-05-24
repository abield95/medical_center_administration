<?php 

namespace CommunicationInfrastructure\CoreInfrastructure;

require_once 'Act.php';

/**
 * Account
 * @Definition A set of financial transactions that are tracked and reported together with a single balance.
 * @UsageNotes Account can be used to represent the accumulated total of billable amounts for goods or services received, payments made for goods or services, and debit and credit accounts between which financial transactions flow. 
 * @Examples Patient accounts, encounter accounts, cost centers, accounts receivable
 */
class Account extends Act
{
	private $balanceAmt;
	private $currencyCode;
	private $interestRateQuantity;
	private $allowedBalanceQuantity;

	function __construct()
	{
		parent::__construct();
		$this->setClassCode("ACCT");
	}


	/**
	 * @param $balanceAmt The sum total of the debit and credit transactions that have posted to the account.
	 * @param $currency from ISO 4217 or from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/datatypes_r2/datatypes_r2.html#dt-MO
	 * @usageNotes The balance of an account will generally be communicated in the currency identified as the account's currencyCode. However, one MAY communicate the balance in alternative currencies. 
	**/
	public function setBalanceAmt($balanceAmt, $currency)
	{
		$this->balanceAmt = array(
			'value' => $balanceAmt,
			'currency' => $currency
		);
	}


	/**
	 * @param $currencyCode from ISO 4217 or from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/datatypes_r2/datatypes_r2.html#dt-MO
	 * @Definition The currency that the account is managed in.
	 * @UsageNotes Specific amounts might be reported in another currency, but this attribute represents the default currency for activity in this account.
	**/
	public function setCurrencyCode($currencyCode)
	{
		$this->currencyCode = $currencyCode;
	}


	/**
	 * @param $amount Monetary Amount
	 * @param $denominator Time for beong divided
	 * @Definition The rate of interest that the account balance may be subject to.
	 * @UsageNotes This may represent interest charged (e.g., for loans, overdue accounts, etc.) or credited (investments, etc.) depending on the type of account. 
	 * @Examples 0.10/1a (10%/year); 0.0005895/1d (.05895%/day)
	 * @FormalConstraint Unit of the denominator PQ data type SHALL be comparable to seconds; i.e., the denominator must be measured in time.
	**/
	public function setInterestRateQuantity($amount, $lenghOfTime)
	{
		if ($lenghOfTime == "0") {
			return;
		}
		$this->interestRateQuantity = $amount . "/" . $lenghOfTime;
	}


	/**
	 * @param $allowedBalanceQuantity An interval describing the minimum and maximum allowed balances for an account.
	 * @UsageNotes These are not necessarily 'hard' limits (i.e., the account may go above or below the specified amounts), however, they represent the 'target' range for the account, and there may be consequences for going outside the specified boundaries. It is not necessary to specify both upper and lower limits (or either) for an account.
	 * @Examples Stop loss limits, credit limits
	**/
	public function addAllowedBalanceQuantity($allowedBalanceQuantity)
	{
		if (!is_array($this->allowedBalanceQuantity)) {
			$this->allowedBalanceQuantity = array();
		}

		$this->allowedBalanceQuantity[] = $allowedBalanceQuantity;
	}
}

 ?>