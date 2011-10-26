<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a store module for PyroCMS
 *
 * @author 		Jaap Jolman And Kevin Meier - pyrocms-store Team
 * @website		http://jolman.eu
 * @package 	PyroCMS
 * @subpackage 	Store Module
**/
class Checkout extends Public_Controller
{

	public function __construct(){

		parent::__construct();

		// Load the required classes
		$this->load->library('cart');
		$this->load->library('paypal');
		$this->load->library('authorize');
		$this->load->library('twoco');
		$this->load->model('store_m');
		$this->lang->load('store');
		
		$this->template->append_metadata(css('store.css', 'store'))
						->append_metadata(js('store.js', 'store'));
	}
	
	public function index(){
		redirect('store/checkout/process/paypal');
	}
	
	public function process($gateway,$orders_id){
		
		switch($gateway)
		{
			case 'paypal':
				$this->paypal->addField('business', 'payments@odin-ict.nl');
				$this->paypal->addField('currency_code', 'EUR');
				$this->paypal->addField('return', site_url('/store/checkout/status/paypal/success/' . $orders_id . '/'));
				$this->paypal->addField('cancel_return', site_url('/store/checkout/status/paypal/failure/' . $orders_id . '/'));
				$this->paypal->addField('notify_url', site_url('/store/checkout/ipn/paypal/' . $orders_id . '/'));
				
				if($this->cart->contents()) {
					$this->paypal->addField('item_name', '');
					$this->paypal->addField('amount', '');
					$this->paypal->addField('item_number', '');
					$this->paypal->addField('custom', 'muri-khao');
				}
				$this->paypal->enableTestMode();
				
				$this->paypal->submitPayment();
			break;
			
			case 'authorize':
				$this->authorize->setUserInfo('YOUR_LOGIN', 'YOUR_SECRET_KEY');
				$this->authorize->addField('x_Receipt_Link_URL', site_url('/store/checkout/status/authorize/success/' . $orders_id . '/'));
				$this->authorize->addField('x_Relay_URL', site_url('/store/checkout/ipn/authorize/' . $orders_id . '/'));
				
				$this->authorize->addField('x_Description', 'T-Shirt');
				$this->authorize->addField('x_Amount', '9.99');
				$this->authorize->addField('x_Invoice_num', rand(1, 100));
				$this->authorize->addField('x_Cust_ID', 'muri-khao');
				
				$this->authorize->enableTestMode();
				
				$this->authorize->submitPayment();
			break;
			
			case 'twoco':
				$this->twoco->addField('sid', 'YOUR_VENDOR_ID');
				$this->twoco->addField('cart_order_id', rand(1, 100));
				$this->twoco->addField('total', '9.99');
				$this->twoco->addField('x_Receipt_Link_URL', site_url('/store/checkout/ipn/twoco/' . $orders_id . '/'));
				$this->twoco->addField('tco_currency', 'USD');
				$this->twoco->addField('custom', 'muri-khao');
				
				$this->twoco->enableTestMode();
				
				$this->twoco->submitPayment();
			break;
		}
	}
	
	public function ipn($gateway,$orders_id){
		
		switch($gateway)
		{
			case 'paypal':
				$this->paypal->ipnLog = TRUE;
				$this->paypal->enableTestMode();
				if ($this->paypal->validateIpn()) {
					if ($this->paypal->ipnData['payment_status'] == 'Completed'){
						 $this->store_m->ipn_paypal_success($orders_id);
					} else {
						 $this->store_m->ipn_paypal_failure($orders_id,$this->paypal->ipnData);
					}
				}
			break;
			
			case 'authorize':
				$this->authorize->ipnLog = TRUE;
				$this->authorize->setUserInfo('YOUR_LOGIN', 'YOUR_SECRET_KEY');
				$this->authorize->enableTestMode();
				if ($this->authorize->validateIpn()) {
					$this->store_m->ipn_authorize_success($orders_id);
				} else {
					$this->store_m->ipn_authorize_failure($orders_id,$this->authorize->ipnData);
				}
			break;
			
			case 'twoco':
				$this->twoco->ipnLog = TRUE;
				$this->twoco->setSecret('YOUR_SECRET_KEY');
				$this->twoco->enableTestMode();
				if ($this->twoco->validateIpn()) {
					$this->store_m->ipn_twoco_success($orders_id);
				} else {
					$this->store_m->ipn_twoco_failure($orders_id,$this->twoco->ipnData);
				}
			break;
		}
	}
	
	public function status($gateway){
		
		switch($gateway)
		{
			case 'paypal':
				
			break;
			
			case 'authorize':
			
			break;
			
			case 'twoco':
			
			break;
		}
	}
	
}