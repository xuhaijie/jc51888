<?php
	class JobsAction extends BaseAction{
		public function index(){
			import("ORG.Util.Page");
			$_jobs=M('jobs');
			$job_id = getTypeID(JOBS);

			$count   = $_jobs->where("`pid` in ($job_id)")->count();

			$page_jobs = $this->config('page_jobs');
			$page    = new Page($count,$page_jobs ? $page_jobs : $this->config('page_default'));
			
			$jobs = $_jobs->where("`pid` in ($job_id)")
							 ->order('`order` desc,`id` desc')
							 ->limit($page->firstRow.','.$page->listRows)
							 ->select();
						 
			foreach($jobs as $key=>$value)
			{
				$jobs[$key]['url'] = __ROOT__.'/jobs/'.$value['id'];
			}
			$this->assign('list',$jobs);	 
			
			$this->assign('page',$page->show());
			$this->display();
		}

		public function jobs_info(){
			$_jobs=M('jobs');
			$id = intval($_GET['id']);
			
			$jobs = $_jobs->where("`id`=$id")->find();

			if(!$jobs) $this->_404();

			$this->assign('jobs',$jobs);	
			$this->display();
		}

		public function seek_job(){
			$_jobs=M('jobs');
			$id  = intval($_GET['id']);
			$job = M('jobs')->where("`id`=$id")->find();
			if(!$job){
				$this->_404();	
			}
			$this->assign('job',$job);
			$this->display();
		}

		public function add_job(){
			if($_SESSION['verify']!=md5($_POST['captcha'])){
				$this->error('验证码错误');
			}

			$order = M('apply');
			$this->safe();
			if($order->add($_POST)){
				$this->success('信息提交成功');	
			}else{
				$this->error('信息提交失败,请稍候再试');
			}
		}
	}
?>