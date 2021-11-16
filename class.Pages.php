<?php
	class Pages {
		var $rowsPerPage;
		var $numRows;
		var $currentPage;
		var $pageVarName;
		var $pagesRegion;

		var $styleTitle   = 'pages_title';
		var $stylePage    = 'page-link';
		var $styleCurrent = 'pages_current';
		var $styleArrows  = 'page-link';

		var $tplHeader = '';
		var $tplFooter = '';

		function Pages($numRows = 30, $rowsPerPage = 3, $pageVarName = 'page') {
			$this->numRows = $numRows;
			$this->rowsPerPage = $rowsPerPage;
			$this->pageVarName = $pageVarName;
			if (!isset($GLOBALS['_GET'][$pageVarName])) {
				$this->currentPage = 1;
			} else {
				if ($GLOBALS['_GET'][$pageVarName] <= 0 || $GLOBALS['_GET'][$pageVarName] > $this->getPagesCount()) {
					$this->currentPage = 1;
				} else {
					$this->currentPage = $GLOBALS['_GET'][$pageVarName];
				}
			}

			$this->pagesRegion = 3;
		}

		function getRowsPerPage() {
			return $this->rowsPerPage;
		}

		function getNumRows() {
			return $this->numRows;
		}

		function getCurrentPage() {
			if (isset($GLOBALS['_GET'][$this->pageVarName]))
				$this->currentPage = $GLOBALS['_GET'][$this->pageVarName];
			else $this->currentPage = 1;

			return $this->currentPage;
		}

		function getPagesCount() {
			$result = $this->numRows / $this->rowsPerPage;
			if ($result != floor($result)) $result++;
			$result = floor($result);
			return $result;
		}

		function getMinRow($page = '') {
			if (!$page) $page = $this->currentPage;
			return ($this->rowsPerPage*($page-1) + 1);
		}

		function getMaxRow($page = '') {
			$maxRow = null;
			if (!$page)	$page = $this->currentPage;
			if (($maxRow = $this->getMinRow($page) + $this->rowsPerPage - 1) > $this->numRows)
				return $this->numRows;
			else
				return $maxRow;
		}

		function getNextPage($page = '') {
			if (!$page) $page = $this->currentPage;
			if ($page < $this->getPagesCount())
				return $page + 1;
			else
				return $this->getPagesCount();
		}

		function getPrevPage($page = '') {
			if (!$page)	$page = $this->currentPage;
			if ($page > 1)
				return $page - 1;
			else
				return 1;
		}

		function getLimit($page = '') {
			$this->currentPage = $this->getCurrentPage();
			return ($this->getMinRow($this->currentPage)-1 . ", " . $this->rowsPerPage);
		}

		function getRealLimit($page = '') {
			$this->currentPage = $this->getCurrentPage();
			if ((($this->getMinRow($this->currentPage)-1)+ $this->rowsPerPage ) > $this->numRows )
				return ($this->getMinRow($this->currentPage)-1 . ", " . ($this->numRows-($this->getMinRow($this->currentPage)-1)));
			else
				return ($this->getMinRow($this->currentPage)-1 . ", " . $this->rowsPerPage);
		}

		function getPageLinks($href) {
			if (($pagesCount = $this->getPagesCount()) > 1) {
				$str = '';

				if (($startPage = $this->currentPage - $this->pagesRegion) < 1)	$startPage = 1;
				if (($endPage = $this->currentPage + $this->pagesRegion) > $pagesCount) $endPage = $pagesCount;

				for ($i = $startPage; $i <= $endPage; $i++) {
					if ($i == $this->currentPage) $str.= '<li class="page-item active"><a class="page-link" href="'.str_replace("{PAGE}", $i, $href).'">'.$i.'</a></li>';
					else $str.= $this->getPageLink($i, $i, $href);
				}

				//$str = '<a href="'.str_replace("{PAGE}", 1, $href).'" class="'.$class.'">������</a>'.$str;

				if (($this->currentPage > 1) && ($this->currentPage <= $pagesCount+1)) {
					$page_num = $this->currentPage - 1;
					$str = '<li class="page-item page-prev"><a href="'.str_replace("{PAGE}", $page_num, $href).'" class="'.$this->styleArrows.'">Пред</a></li>'.$str;
				}

				if ($this->currentPage < $pagesCount) {
					$page_num = $this->currentPage + 1;
					$str.= '<li class="page-item page-next"><a href="'.str_replace("{PAGE}", $page_num, $href).'" class="'.$this->styleArrows.'">След</a></li>';
				}

				//$str = $str.'<a href="'.str_replace("{PAGE}", $pagesCount, $href).'" class="'.$class.'">���������</a>';

				return $str;
			} else {
				return '';
			}
		}

		function getPageLink($page, $title, $href) {
			return '<li class="page-item"><a href="'.str_replace("{PAGE}", $page, $href).'" class="'.$this->stylePage.'">'.$title.'</a></a>';
		}

		function getRowsInfo($page = '') {
			global $currentPage;
			if (!$page)
				$page = $currentPage;
			return $this->getMinRow($page) . " - " . $this->getMaxRow($page) . " / " . $this->numRows;
		}

		function getPagesInfo($page = '') {
			global $currentPage;
			if (!$page)
				$page = $currentPage;
			return $currentPage . " / " . $this->getPagesCount();
		}

		function getParamUrl($param_array) {
			$url = '';
			while (list($key, $val) = each($param_array)) {
				$url.= '&'.$key.'='.$val;
			}
			return $url;
		}

		function parse($url, $title = '', $assign_to = 'PAGES') {
			global $tpl;

			if (empty($url)) $url = $_SERVER['PHP_SELF'].'?page_id='.PAGE_ID.'&lang='.LANG_ID.'&page={PAGE}';

			if ($this->getPagesCount() > 1) {
				if (!empty($title)) {
					$view = '<span class="'.$this->styleTitle.'">'.$title.":</span>&nbsp;".$this->getPageLinks($url);
				} else {
					$view = $this->getPageLinks($url);
				}

				$view = $this->tplHeader.$view.$this->tplFooter;
				$tpl->assign($assign_to, $view);
			} else {
				$tpl->assign($assign_to, "");
			}
		}
	}
?>
