<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;
  use Carbon\Carbon;

	class AdminPeriodicMaintenancesController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "id";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = true;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
      $this->button_action_style = "button_icon";
      if (CRUDBooster::myPrivilegeId() == 3) {
        // $this->button_add = false;
        $this->button_export = false;
      } else {
        $this->button_export = true;
      }
      $this->button_add = true;
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = false;
			$this->button_filter = true;
			$this->button_import = false;
			$this->table = "periodic_maintenances";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>'ID',"name"=>"id"];

			$this->col[] = ["label"=>trans("table.devices_serial_number"),"name"=>"devices_serial_number","callback"=>function($row) {
        return '<a href="'.url(config('crudbooster.ADMIN_PATH').'/devices/detail/'.DB::table('devices')->where('serial_number',$row->devices_serial_number)->value('id')).'">'.$row->devices_serial_number.'</a>';
      }];

			$this->col[] = ["label"=>trans("table.devices"),"name"=>"devices_serial_number","join"=>"devices,name"];

      if (CRUDBooster::myPrivilegeId() != 3) {
			  $this->col[] = ["label"=>trans("table.technicians_id"),"name"=>"technicians_id","join"=>"cms_users,name","callback"=>function($row) {
          return '<a href="'.url(config('crudbooster.ADMIN_PATH').'/technicians/detail/'.$row->technicians_id).'">'.DB::table('cms_users')->where('id',$row->technicians_id)->value('name').'</a>';
        }];
      }

			$this->col[] = ["label"=>trans("table.created_at"),"name"=>"created_at","callback"=>function($row) {
        $daata = Carbon::parse($row->created_at);
        return $daata->format("Y-m-d");
      }];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>trans("table.devices_serial_number"),'name'=>'devices_serial_number','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'devices,serial_number'];
      if (CRUDBooster::myPrivilegeId() != 3) {
        $this->form[] = ['label'=>trans("table.technicians_id"),'name'=>'technicians_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'cms_users,name'];
      }
      $this->form[] = ['label'=>trans("table.report"),'name'=>'report','type'=>'textarea','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Devices Serial Number","name"=>"devices_serial_number","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Technicians Id","name"=>"technicians_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"technicians,id"];
			//$this->form[] = ["label"=>"Report","name"=>"report","type"=>"textarea","required"=>TRUE,"validation"=>"required|string|min:5|max:5000"];
			# OLD END FORM

			/*
	        | ----------------------------------------------------------------------
	        | Sub Module
	        | ----------------------------------------------------------------------
			| @label          = Label of action
			| @path           = Path of sub module
			| @foreign_key 	  = foreign key of sub table/module
			| @button_color   = Bootstrap Class (primary,success,warning,danger)
			| @button_icon    = Font Awesome Class
			| @parent_columns = Sparate with comma, e.g : name,created_at
	        |
	        */
	        $this->sub_module = array();

	        /*
	        | ----------------------------------------------------------------------
	        | Add More Action Button / Menu
	        | ----------------------------------------------------------------------
	        | @label       = Label of action
	        | @url         = Target URL, you can use field alias. e.g : [id], [name], [title], etc
	        | @icon        = Font awesome class icon. e.g : fa fa-bars
	        | @color 	   = Default is primary. (primary, warning, succecss, info)
	        | @showIf 	   = If condition when action show. Use field alias. e.g : [id] == 1
	        |
	        */
	        $this->addaction = array();


	        /*
	        | ----------------------------------------------------------------------
	        | Add More Button Selected
	        | ----------------------------------------------------------------------
	        | @label       = Label of action
	        | @icon 	   = Icon from fontawesome
	        | @name 	   = Name of button
	        | Then about the action, you should code at actionButtonSelected method
	        |
	        */
	        $this->button_selected = array();


	        /*
	        | ----------------------------------------------------------------------
	        | Add alert message to this module at overheader
	        | ----------------------------------------------------------------------
	        | @message = Text of message
	        | @type    = warning,success,danger,info
	        |
	        */
	        $this->alert        = array();



	        /*
	        | ----------------------------------------------------------------------
	        | Add more button to header button
	        | ----------------------------------------------------------------------
	        | @label = Name of button
	        | @url   = URL Target
	        | @icon  = Icon from Awesome.
	        |
	        */
	        $this->index_button = array();



	        /*
	        | ----------------------------------------------------------------------
	        | Customize Table Row Color
	        | ----------------------------------------------------------------------
	        | @condition = If condition. You may use field alias. E.g : [id] == 1
	        | @color = Default is none. You can use bootstrap success,info,warning,danger,primary.
	        |
	        */
	        $this->table_row_color = array();


	        /*
	        | ----------------------------------------------------------------------
	        | You may use this bellow array to add statistic at dashboard
	        | ----------------------------------------------------------------------
	        | @label, @count, @icon, @color
	        |
	        */
	        $this->index_statistic = array();
          if (CRUDBooster::myPrivilegeId() == 3) {
            $this->index_statistic[] = ['label'=>trans('crudbooster.today'),'count'=>DB::table('periodic_maintenances')->where('technicians_id',CRUDBooster::myPrivilegeId())->whereDate('created_at',Carbon::today())->count(),'icon'=>'fa fa-wrench','color'=>'yellow','width'=>'col-sm-4'];
            $this->index_statistic[] = ['label'=>trans('crudbooster.yesterday'),'count'=>DB::table('periodic_maintenances')->where('technicians_id',CRUDBooster::myPrivilegeId())->whereDate('created_at',Carbon::yesterday()->format('Y-m-d'))->count(),'icon'=>'fa fa-wrench','color'=>'yellow','width'=>'col-sm-4'];
            $this->index_statistic[] = ['label'=>trans('crudbooster.last_week'),'count'=>DB::table('periodic_maintenances')->where('technicians_id',CRUDBooster::myPrivilegeId())->whereDate('created_at','<=',Carbon::today()->format('Y-m-d'))->whereDate('created_at','>=',Carbon::today()->subWeek()->format('Y-m-d'))->count(),'icon'=>'fa fa-wrench','color'=>'yellow','width'=>'col-sm-4'];
            $this->index_statistic[] = ['label'=>trans('crudbooster.last_month'),'count'=>DB::table('periodic_maintenances')->where('technicians_id',CRUDBooster::myPrivilegeId())->whereDate('created_at','<=',Carbon::today()->format('Y-m-d'))->whereDate('created_at','>=',Carbon::today()->subMonth()->format('Y-m-d'))->count(),'icon'=>'fa fa-wrench','color'=>'yellow','width'=>'col-sm-6'];
            $this->index_statistic[] = ['label'=>trans('crudbooster.total'),'count'=>DB::table('periodic_maintenances')->where('technicians_id',CRUDBooster::myPrivilegeId())->count(),'icon'=>'fa fa-wrench','color'=>'yellow','width'=>'col-sm-6'];
          }else {
            $this->index_statistic[] = ['label'=>trans('crudbooster.today'),'count'=>DB::table('periodic_maintenances')->whereDate('created_at',Carbon::today())->count(),'icon'=>'fa fa-wrench','color'=>'yellow','width'=>'col-sm-4'];
            $this->index_statistic[] = ['label'=>trans('crudbooster.yesterday'),'count'=>DB::table('periodic_maintenances')->whereDate('created_at',Carbon::yesterday()->format('Y-m-d'))->count(),'icon'=>'fa fa-wrench','color'=>'yellow','width'=>'col-sm-4'];
            $this->index_statistic[] = ['label'=>trans('crudbooster.last_week'),'count'=>DB::table('periodic_maintenances')->whereDate('created_at','<=',Carbon::today()->format('Y-m-d'))->whereDate('created_at','>=',Carbon::today()->subWeek()->format('Y-m-d'))->count(),'icon'=>'fa fa-wrench','color'=>'yellow','width'=>'col-sm-4'];
            $this->index_statistic[] = ['label'=>trans('crudbooster.last_month'),'count'=>DB::table('periodic_maintenances')->whereDate('created_at','<=',Carbon::today()->format('Y-m-d'))->whereDate('created_at','>=',Carbon::today()->subMonth()->format('Y-m-d'))->count(),'icon'=>'fa fa-wrench','color'=>'yellow','width'=>'col-sm-6'];
            $this->index_statistic[] = ['label'=>trans('crudbooster.total'),'count'=>DB::table('periodic_maintenances')->count(),'icon'=>'fa fa-wrench','color'=>'yellow','width'=>'col-sm-6'];
          }


	        /*
	        | ----------------------------------------------------------------------
	        | Add javascript at body
	        | ----------------------------------------------------------------------
	        | javascript code in the variable
	        | $this->script_js = "function() { ... }";
	        |
	        */
	        $this->script_js = NULL;


            /*
	        | ----------------------------------------------------------------------
	        | Include HTML Code before index table
	        | ----------------------------------------------------------------------
	        | html code to display it before index table
	        | $this->pre_index_html = "<p>test</p>";
	        |
	        */
	        $this->pre_index_html = null;



	        /*
	        | ----------------------------------------------------------------------
	        | Include HTML Code after index table
	        | ----------------------------------------------------------------------
	        | html code to display it after index table
	        | $this->post_index_html = "<p>test</p>";
	        |
	        */
	        $this->post_index_html = null;



	        /*
	        | ----------------------------------------------------------------------
	        | Include Javascript File
	        | ----------------------------------------------------------------------
	        | URL of your javascript each array
	        | $this->load_js[] = asset("myfile.js");
	        |
	        */
	        $this->load_js = array();



	        /*
	        | ----------------------------------------------------------------------
	        | Add css style at body
	        | ----------------------------------------------------------------------
	        | css code in the variable
	        | $this->style_css = ".style{....}";
	        |
	        */
	        $this->style_css = NULL;



	        /*
	        | ----------------------------------------------------------------------
	        | Include css File
	        | ----------------------------------------------------------------------
	        | URL of your css each array
	        | $this->load_css[] = asset("myfile.css");
	        |
	        */
	        $this->load_css = array();


	    }


	    /*
	    | ----------------------------------------------------------------------
	    | Hook for button selected
	    | ----------------------------------------------------------------------
	    | @id_selected = the id selected
	    | @button_name = the name of button
	    |
	    */
	    public function actionButtonSelected($id_selected,$button_name) {
	        //Your code here

	    }


	    /*
	    | ----------------------------------------------------------------------
	    | Hook for manipulate query of index result
	    | ----------------------------------------------------------------------
	    | @query = current sql query
	    |
	    */
	    public function hook_query_index(&$query) {
	        //Your code here
          if (CRUDBooster::myPrivilegeId() == 3) {
            $query->where('periodic_maintenances.technicians_id',CRUDBooster::myId());
          }
	    }

	    /*
	    | ----------------------------------------------------------------------
	    | Hook for manipulate row of index table html
	    | ----------------------------------------------------------------------
	    |
	    */
	    public function hook_row_index($column_index,&$column_value) {
	    	//Your code here
	    }

	    /*
	    | ----------------------------------------------------------------------
	    | Hook for manipulate data input before add data is execute
	    | ----------------------------------------------------------------------
	    | @arr
	    |
	    */
	    public function hook_before_add(&$postdata) {
	        //Your code here
          if (CRUDBooster::myPrivilegeId() == 3) {
            $postdata['technicians_id'] = CRUDBooster::myId();
          }
	    }

	    /*
	    | ----------------------------------------------------------------------
	    | Hook for execute command after add public static function called
	    | ----------------------------------------------------------------------
	    | @id = last insert id
	    |
	    */
	    public function hook_after_add($id) {
	        //Your code here

	    }

	    /*
	    | ----------------------------------------------------------------------
	    | Hook for manipulate data input before update data is execute
	    | ----------------------------------------------------------------------
	    | @postdata = input post data
	    | @id       = current id
	    |
	    */
	    public function hook_before_edit(&$postdata,$id) {
	        //Your code here
          if (CRUDBooster::myPrivilegeId() == 3) {
            $postdata['technicians_id'] = CRUDBooster::myId();
          }
	    }

	    /*
	    | ----------------------------------------------------------------------
	    | Hook for execute command after edit public static function called
	    | ----------------------------------------------------------------------
	    | @id       = current id
	    |
	    */
	    public function hook_after_edit($id) {
	        //Your code here

	    }

	    /*
	    | ----------------------------------------------------------------------
	    | Hook for execute command before delete public static function called
	    | ----------------------------------------------------------------------
	    | @id       = current id
	    |
	    */
	    public function hook_before_delete($id) {
	        //Your code here

	    }

	    /*
	    | ----------------------------------------------------------------------
	    | Hook for execute command after delete public static function called
	    | ----------------------------------------------------------------------
	    | @id       = current id
	    |
	    */
	    public function hook_after_delete($id) {
	        //Your code here

	    }



	    //By the way, you can still create your own method in here... :)


	}
