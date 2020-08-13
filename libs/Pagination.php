<?php
    class Pagination{
        private $totalItems;
        private $totalItemsPerPage = 1;
        private $pageDisplay = 3;
        private $totalPage;
        private $currentPage;
        private $urlSymbol;
        private $url;
        private $countElements;

        public function __construct($totalItems, $pagination){
            $this->totalItems        = $totalItems;
            $this->totalItemsPerPage = $pagination['totalItemsPerPage'];
            $this->currentPage       = $pagination['currentPage'];
            $this->pageDisplay       = $pagination['pageRange'];
            $this->totalPage         = ceil($this->totalItems/$this->totalItemsPerPage);
            $this->urlSymbol         = strrpos($_SERVER['REQUEST_URI'],"?")? '&' : '?';
            $this->url               = $_SERVER['REQUEST_URI'];
            $this->countElements     = $this->totalItemsPerPage;

            // Delete previous ?page=
            if(!strrpos($this->url ,''.$this->urlSymbol.'page=') === false){
                $url= substr($this->url ,0,strpos($this->url ,''.$this->urlSymbol.'page='));
                $this->url = $url;
            }elseif(substr($this->url ,0,strpos($this->url , '?page='))){
                $url= substr($this->url ,0,strpos($this->url ,'page='));
                $this->url = $url;
                $this->urlSymbol = '';
            }
            // count element
            if($this->totalItems < $this->totalItemsPerPage){
                $this->countElements= $totalItems;
            }elseif($this->currentPage == $this->totalPage){
                $this->countElements = $this->totalItems % $this->totalItemsPerPage;
            }else{
                $this->countElements = $this->totalItemsPerPage;
            }
        }
        public function getter(){
            $display = $this->pageDisplay;
            if($this->pageDisplay > $this->totalPage){
                $display = $this->totalPage;
            }
            return array(
                'totalItems'=> $this->totalItems,
                'totalItemsPerPage' => $this->totalItemsPerPage,
                'currentPage' => $this->currentPage,
                'totalPage' => $this->totalPage,
                'pageDisplay' => $display,
                'countElements' => $this->countElements
            );
        }

        public function showPage(){
            $html = '';
            $start='';
            $prev='';
            $next='';
            $end='';

            // If there's more than 1 page, show start, prev, next, end
            if($this->totalPage > 1){
                $start = '<button class="btn btn-light">Start</button>';
                $prev = '<button class="btn btn-light">End</button>';
                if($this->currentPage > 1){
                    $start = '<button class="btn btn-light"><a href="'.$this->url.''.$this->urlSymbol.'page=1">Start</a></button>';
                    $prev = '<button class="btn btn-light"><a href="'.$this->url.''.$this->urlSymbol.'page='.($this->currentPage-1).'">Previous</a></button>';
                }
                $next = '<button class="btn btn-light">Next</button>';
                $end = '<button class="btn btn-light">End</button>';
                if($this->currentPage < $this->totalPage){
                    $next 	= '<button class="btn btn-light"><a href="'.$this->url.''.$this->urlSymbol.'page='.($this->currentPage+1).'">Next</a></button>';
                    $end 	= '<button class="btn btn-light"><a href="'.$this->url.''.$this->urlSymbol.'page='.$this->totalPage.'">End</a></button>';
                }
            }
            $startPage = '';
            $endPage ='';
            
            if($this->currentPage ==1 && $this->totalPage >= $this->pageDisplay){
                $startPage = 1;
                $endPage = $this->pageDisplay;
            } elseif($this->currentPage == $this->totalPage && $this->totalPage >= $this->pageDisplay){
                $endPage = $this->totalPage;
                $startPage = $this->totalPage - $this->pageDisplay+1;
            } elseif($this->totalPage <= $this->pageDisplay){
                $endPage = $this->totalPage;
                $startPage = 1;
            }else{
                if($this->pageDisplay % 2 == 0){
                    $startPage = $this->currentPage - $this->pageDisplay/2 +1;
                    $endPage= $this->currentPage + $this->pageDisplay/2;
                } else{
                    $startPage = $this->currentPage - ($this->pageDisplay-1)/2;
                    $endPage = $this->currentPage + ($this->pageDisplay-1)/2;
                }
            }

            $listPages = '';

            if($this->totalPage > 1){
                for($i = $startPage; $i <= $endPage; $i++){
                    if($i == $this->currentPage){
                        $listPages .= '<button class="btn btn-light">'.$i.'</button>';
                    } else{
                        $listPages .= '<button class="btn btn-light">'.'<a href="'.$this->url.''.$this->urlSymbol.'page='.$i.'">'.$i.'</button>';
                    }
                }
            }else{
                $listPages='<button class="btn btn-light"><a href="#">1</a>';
            }
           
            $html = "<div class = 'row float-right'>" . $start .$prev .$listPages .$next .$end . "</div>";

            return $html;
        }  
    }
?>