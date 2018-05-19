<?php

	ini_set('display_errors',1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	include 'db.php';

	class DataOperation extends database {

		public function insert_record($table, $fields) {
			$sql  = "";
			$sql .= "INSERT INTO ".$table;
			$sql .= "(".implode(",",array_keys($fields)).") VALUES ";
			$sql .= "('".implode("','", array_values($fields))."')";
			$query = mysqli_query($this->conn, $sql);
			if($query) {
				return true;
			}
		}

		public function fetch_record($table) {
			$rec = array();
			$sql = "select * from $table";
			$query = mysqli_query($this->conn, $sql);
			while($row = mysqli_fetch_assoc($query)) {
				$rec[] = $row;
			}
			return $rec;
		}

		public function select_record($table, $where) {
			$sql = "";
			$condition = "";
			foreach($where as $key => $value) {
				$condition .= $key ."='" .$value."' AND ";
			}
			/*$cond_arr = explode(" ",$condition);
			echo "<pre>", print_r($cond_arr,true), "<br>";
			$count = count($cond_arr)."<br>";
			unset($cond_arr[$count-1]);
			unset($cond_arr[$count-2]);
			echo implode(" ",$cond_arr)."<br>";*/
			//echo chop($condition,"AND ");
			$condition = substr($condition,0,-5);
			$sql .= "SELECT * FROM $table where $condition";
			$query = mysqli_query($this->conn,$sql);
			$rec = mysqli_fetch_array($query);
			return $rec;
		}
		public function update_record($table,$where,$fields) {
			$sql = "";
			$condition = "";
			foreach($where as $key=>$value) {
				$condition .=  $key . "='" . $value . "' AND ";
			}
			$condition = substr($condition,0,-5);
			foreach($fields as $key=>$value) {
				//Update table SET m_name='' and qty = '' where id = '';
				$sql .= $key . "='".$value."', "; 
			}
			//echo $sql;
			$sql = substr($sql,0,-2);
			$sql = "UPDATE ".$table." SET ".$sql." WHERE ".$condition;
			if(mysqli_query($this->conn,$sql)) {
				return true;
			}
		}
	}



	$obj = new DataOperation;

	if(isset($_POST['submit'])) {
		$myArray = array(
			"m_name" => $_POST['mname'],
			'qty' => $_POST['qty']
		);
	if($obj->insert_record('medicines', $myArray)) {
		header("location:index.php?msg=record inserted");
	}
	}

	if(isset($_POST['edit'])) {
		$myArray = array(
			"m_name" => $_POST['mname'],
			'qty' => $_POST['qty']
		);
	$id = $_POST['id'];
	$where = array('mid'=>$id);
	if($obj->update_record('medicines', $where, $myArray)) {
		header("location:index.php?msg=record update");
	}
	
	}

?>