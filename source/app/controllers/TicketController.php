<?php
class TicketController extends BaseController
{
	public $model_ticket, $data = [];
	public function __construct()
	{
		$this->model_ticket = $this->model("TicketModel");
	}
	public function update($id_loaive, $price)
	{
		echo $this->model_ticket->update($id_loaive, $price);
	}
}
