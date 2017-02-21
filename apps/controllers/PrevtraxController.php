<?php

class PrevtraxController extends ControllerBase {

	public function initialize() {
		\Phalcon\Tag::appendTitle('PK拾');
	}

	public function indexAction($page = 1) {
		$no = $this->request->get('no', 'trim');
		$num1 = $this->request->get('num1', 'trim');
		$num2 = $this->request->get('num2', 'trim');
		$num3 = $this->request->get('num3', 'trim');
		$num4 = $this->request->get('num4', 'trim');
		$num5 = $this->request->get('num5', 'trim');
		$num6 = $this->request->get('num6', 'trim');
		$num7 = $this->request->get('num7', 'trim');
		$num8 = $this->request->get('num8', 'trim');
		$num9 = $this->request->get('num9', 'trim');
		$num10 = $this->request->get('num10', 'trim');
		$date = $this->request->get('date', 'trim');
		$query = $this->modelsManager->createBuilder()->from('Prevtraxs');

		if ($no) {
			$query->andwhere("no = :no:", array('no' => $no));
		}

		if ($num1) {
			$query->andwhere("num1 = :num1:", array('num1' => $num1));
		}

		if ($num2) {
			$query->andwhere("num2 = :num2:", array('num2' => $num2));
		}

		if ($num3) {
			$query->andwhere("num3 = :num3:", array('num3' => $num3));
		}

		if ($num4) {
			$query->andwhere("num4 = :num4:", array('num4' => $num4));
		}

		if ($num1) {
			$query->andwhere("num1 = :num1:", array('num1' => $num1));
		}

		if ($num5) {
			$query->andwhere("num5 = :num5:", array('num5' => $num5));
		}

		if ($num6) {
			$query->andwhere("num6 = :num6:", array('num6' => $num6));
		}

		if ($num7) {
			$query->andwhere("num7 = :num7:", array('num7' => $num7));
		}

		if ($num8) {
			$query->andwhere("num8 = :num8:", array('num8' => $num8));
		}

		if ($num9) {
			$query->andwhere("num9 = :num9:", array('num9' => $num9));
		}

		if ($date) {
			$query->andwhere("date = :date:", array('date' => $date));
		}

		$query->orderBy('id desc');

		$paginator = new \Phalcon\Paginator\Adapter\QueryBuilder(array(
			"builder" => $query,
			"limit" => 30,
			"page" => $page
		));

		$this->view->setVar("page", $paginator->getPaginate());
	}

	public function getAction($page) {
		if ($page <= 0 ) {
			$this->redirect('prevtrax/index');
		}

		echo '<meta http-equiv="refresh" content="10; url=\''.'http://bwlc.myleft.org/prevtrax/get/'.((int)$page-1).'\'">';
		echo 'Page: '.$page."<br>".PHP_EOL;
		ob_flush();
		flush();
		$client = new Phalcon\Http\Client\Adapter\Curl('http://www.bwlc.net/bulletin/prevtrax.html?page='.$page);

		$response = $client->get();
		$body = strip_tags($response->getBody(), "<table><tr><td>");
		$regex ="/<tr.*?>[\s\r\n]+<td>(\d+)<\/td>[\s\r\n]+<td>([\d,]+)<\/td>[\s\r\n]+<td>([\d-\s:]+)<\/td>[\s\r\n]+<\/tr>/i";
		if(preg_match_all($regex, $body, $matches)){
		        foreach ($matches[1] as $key => $no) {
						echo 'NO: '.$no."<br>".PHP_EOL;
						ob_flush();
						flush();
						$prevtrax = Prevtraxs::findFirst(array('no = :no:', 'bind' => array('no' => $no)));
						if (!$prevtrax) {
							$nums = explode(',', $matches[2][$key]);
							$prevtrax = new Prevtraxs;
							$prevtrax->no = $no;
							$prevtrax->num1 = $nums[0];
							$prevtrax->num2 = $nums[1];
							$prevtrax->num3 = $nums[2];
							$prevtrax->num4 = $nums[3];
							$prevtrax->num5 = $nums[4];
							$prevtrax->num6 = $nums[5];
							$prevtrax->num7 = $nums[6];
							$prevtrax->num8 = $nums[7];
							$prevtrax->num9 = $nums[8];
							$prevtrax->num10 = $nums[9];
							$prevtrax->date = $matches[3][$key].':00';
							if (!$prevtrax->save()) {
								var_dump($prevtrax->getMessages());
								exit;
							}
						}
		        }
		}
		exit;
	}

}
