<?php 

namespace CommunicationInfrastructure\CoreInfrastructure;

include_once 'Act.php';

/**
 * FinancialContract
 * @Defitinion A contract whose value is measured in monetary terms.
 * @Examples Insurance, purchase agreement
 */
class FinancialContract extends Act
{
	private $paymentTermsCode;

	function __construct()
	{
		parent::__construct();
		$this->setClassCode("FCNTRCT");
		$this->paymentTermsCode = NULL;
	}


	/**
	 * @param $paymentTermsCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/PaymentTerms.html
	 * @Definition The payment terms for a contractual agreement or obligation.
	 * @Examples Net 30, on receipt of invoice, upon completion of service
	**/
	public function setPaymentTermsCode($paymentTermsCode)
	{
		$this->paymentTermsCode = array(
			'code' => $paymentTermsCode,
			'codeSystem' => "2.16.840.1.113883.5.91",
			'codeSystemName' => "PaymentTerms",
			'codeSystemVersion' => "1"
		);
	}
}

 ?>