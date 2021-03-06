<?php
namespace Opencart\Catalog\Controller\Api\Order;
class Currency extends \Opencart\System\Engine\Controller {
	public function index(): void {
		$this->load->language('api/order/currency');

		$json = [];

		$this->load->model('localisation/currency');

		$currency_info = $this->model_localisation_currency->getCurrencyByCode($this->request->post['currency']);

		if (!$currency_info) {
			$json['error'] = $this->language->get('error_currency');
		}

		if (!$json) {
			$this->session->data['currency'] = $this->request->post['currency'];

			$json['success'] = $this->language->get('text_success');

			unset($this->session->data['shipping_method']);
			unset($this->session->data['shipping_methods']);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
