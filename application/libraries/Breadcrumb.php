<?php

/**
 *
 						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="<?php echo base_url("backoffice") ?>">Home</a> 
								<span class="icon-angle-right"></span>
							</li>
							<li><a href="#"><?php echo $breadcrumb;?></a></li>

							<li class="pull-right no-text-shadow">
								<div id="dashboard-report-range" class="dashboard-date-range tooltips no-tooltip-on-touch-device responsive" >
									<i class="icon-calendar"></i>
									<span></span>
									<i class="icon-angle-down"></i>
								</div>
							</li>
						</ul>
	**/

class Breadcrumb{


	private $crumbs = array();

	public function __construnct( $crumbs = null ){

	}

	public function add( array $link ){
		array_push($this->crumbs, $link);
	}

	public function render(){

		$crumb_size = count( $this->crumbs );
		$breadcrumb = '<ul class="breadcrumb">';
		//as home
		$breadcrumb .= '<li>
								<i class="icon-home"></i>
								<a href="'.site_url("#").'">Beranda</a> 
								';
		if( $crumb_size > 0 )
			$breadcrumb .= '<span class="icon-angle-right"></span>';
		$breadcrumb .= '</li>';


		foreach ($this->crumbs as $key => $crumb) {
			$breadcrumb .= '
							<li><a href="'.$crumb['link'].'">'.$crumb['label'].'</a>';

			if( $key+1 != $crumb_size )
				$breadcrumb .= '<span class="icon-angle-right"></span>';

			$breadcrumb .= '</li>';
		}

		$breadcrumb .= '</ul>';


		return $breadcrumb;
	}


}
