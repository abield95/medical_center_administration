<?php 

namespace CommunicationInfrastructure\CoreInfrastructure;

include_once 'Act.php';

/**
 * FinancialTransaction
 * @Definition An Act representing the movement of a monetary amount between two accounts.
 * @UsageNotes Financial transactions always occur between two accounts (debit and credit), but there may be circumstances where one or both accounts are implied or inherited from the containing model. In the "order" mood, this represents a request for a transaction to be initiated. In the "event" mood, this represents the posting of a transaction to an account.
 * @Examples Cost of a service, charge for a service, payment of an invoice
 */
class FinancialTransaction extends Act
{
	private $amt;
	private $creditExchangeRateQuantity;
	private $debitExchangeRateQuantity;

	function __construct()
	{
		parent::__construct();
		$this->setClassCode("XACT");
	}


	/**
	 * @param $amount monetary amount
	 * @param $currency from ISO 4217 or from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/datatypes_r2/datatypes_r2.html#dt-MO
	 * @Definition The monetary amount to be transferred from one account (e.g., credit account) to another account (e.g., debit account).
	 * @UsageNotes If the denomination of the amt differs from the denomination of the debit or credit account, then the associated exchange rate should be specified.
	 * @DesignComments Typically, a journal entry identifies both a debit and a credit account, and a text explanation of the transaction. If there are other documents specifying how debit and credit accounts are identified or how transactions are annotated, those documents should be referenced in the Usage Notes. 
	**/
	public function setAmt($amount, $currency)
	{
		$this->amt = array(
			'value' => $amount,
			'currency' => $currency
		);
	}


	/**
	 * @param $creditExchangeRateQuantity A decimal number indicating the rate of exchange to convert the currency of the account being credited to the currency of the transaction net amount. 
	 * @Examples For the purchase of services valued in Mexican pesos using U.S. dollars paid from a Canadian dollar account, the credit exchange ratio would be communicated as real number "r" such that "y (USD) * r = x (CAD)." 
	**/
	public function setCreditExchangeRateQuantity($creditExchangeRateQuantity)
	{
		$this->creditExchangeRateQuantity = $creditExchangeRateQuantity;
	}


	/**
	 * @param $debitExchangeRateQuantity A decimal number indicating the rate of exchange to convert the currency of the account being debited to the currency of the transaction net amount. 
	 * @Examples For the purchase of services valued in Mexican pesos using U.S. dollars paid from a Canadian dollar account, the debit exchange ratio would be communicated as real number "r" such that "y (USD) * r = x (MXP)." 
	**/
	public function setDebitExchangeRateQuantity($debitExchangeRateQuantity)
	{
		$this->debitExchangeRateQuantity = $debitExchangeRateQuantity;
	}
}

 ?>