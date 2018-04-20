<?php
require_once("report.php");
class Inventory_summary extends Report
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function getDataColumns()
	{
		return array($this->lang->line('reports_item_name'), 'Buying Price','Selling Price','Stock Quantity', $this->lang->line('reports_reorder_level'),'Value');
	}
	
	public function getData(array $inputs)
	{
		$this->db->select('name,cost_price, unit_price, quantity, reorder_level, description');
		$this->db->from('items');
		$this->db->where('deleted', 0);	
		$this->db->order_by('name');
		
		return $this->db->get()->result_array();

	}
	
	public function getSummaryData(array $input)
	{
		$this->db->select('unit_price as subtotal');
		$this->db->from('items');
		
		return $this->db->get()->row_array();
	
	}
}
?>