<?

// -------------------------------------------------------------

// Builds Prev/Next Class File

//

// Credits :

//     Base on Original Code from

//     Previous/next v.01 by sephiroth(alessandro@sephiroth.it)

//     http://www.sephiroth.it/download/detail.php?id=64

//

// General Comment Controls

// -- Comments in Brackets [] denotes a Function or Class

// -- Other Comments denote a General comment of a specific code

// Copyright (c) 2001 Lyon Lim - For File Protocol 1.0

//

// Last Updated : 16th February 2002

// --------------------------------------------------------------



// --------------------------------------------------------------

// USAGE

//

/*

<?

   include 'buildNav.php';

   $conn = mysql_connect('localhost','xxxxxx','xxxxxx');

   mysql_select_db('dbname');

   $db = new buildNav;

   $db->offset = 'offset';

   $db->number_type = 'number' (or 'alpha')

   $db->limit = 10;

   $db->execute("SELECT * from murphy ORDER by id ASC");

   while($myrow = mysql_fetch_array($db->sql_result))

   {

      print $myrow["your_column"];

   }

   // -------------------------------

   // CREATE A VAR WITH THE NAV LINKS

   // -------------------------------

   $pages = $db->show_num_pages('&laquo;','&laquo; prev','&raquo;','next &raquo;','|','class=moi');   // show pages

   // OUTPUT THE NAV

   print $pages;



   // -------------------------------

   // RESULTS INFORMATION

   // -------------------------------

   $info = $db->show_info();

   print $info;

?>

*/

// --------------------------------------------------------------
error_reporting(E_ERROR);


    class buildNav // [Class : Controls all Functions for Prev/Next Nav Generation]

    {

        var $limit, $execute, $query;

        function execute($query) // [Function : mySQL Query Execution]

        {

            !isset($_GET[$this->offset]) ? $GLOBALS[$this->offset] = 0 : $GLOBALS[$this->offset] = $_GET[$this->offset];

            $this->sql_result = mysql_query($query);

            $this->total_result = mysql_num_rows($this->sql_result);

            if(isset($this->limit))

            {

                $query .= " LIMIT " . $GLOBALS[$this->offset] . ", $this->limit";

                $this->sql_result = mysql_query($query);

                $this->num_pages = ceil($this->total_result/$this->limit);

            }

        }



        function show_num_pages($frew = '', $rew = '', $ffwd = '', $fwd = '', $separator = '|', $objClass = '', $pasa= '') // [Function : Generates Prev/Next Links]

        {

            $current_pg = $GLOBALS[$this->offset]/$this->limit+1;

            if ($current_pg > 5)

            {

                $fgp = $current_pg - 5 > 0 ? $current_pg - 5 : 1;

                $egp = $current_pg+4;

                if ($egp > $this->num_pages)

                {

                    $egp = $this->num_pages;

                    $fgp = $this->num_pages - 9 > 0 ? $this->num_pages  - 9 : 1;

                }

            }

            else {

                $fgp = 1;

                $egp = $this->num_pages >= 10 ? 10 : $this->num_pages;

            }



            if($this->num_pages > 1) {

                // searching for http_get_vars

                foreach ($GLOBALS[HTTP_GET_VARS] as $_get_name => $_get_value) {

                    if ($_get_name != $this->offset) {

                        $this->_get_vars .= "&$_get_name=$_get_value";

                    }

                }

                //$this->successivo = $GLOBALS[$this->offset] + $this->limit;

                //$this->precedente = $GLOBALS[$this->offset] - $this->limit;
				
                $this->successivo = $GLOBALS[$this->offset] + $this->limit;

                $this->precedente = $GLOBALS[$this->offset] - $this->limit;

                $this->theClass = $objClass;
				
				$this->valor = $pasa;

                if (!empty($rew)) {
                     $return .= ($GLOBALS[$this->offset] > 0) ? "<a href=\"$GLOBALS[PHP_SELF]?$this->offset=$this->precedente$this->_get_vars\"class=\"flechas\">$rew</a> $separator " : "<a class=\"flechas\"> $rew </a>";

                }



                // showing pages

                if ($this->show_pages_number || !isset($this->show_pages_number))

                {

                    for($this->a = $fgp; $this->a <= $egp; $this->a++)

                    {

                        $this->theNext = ($this->a-1)*$this->limit;

                        $_ss_k = floor($this->theNext/26);

                        if ($this->theNext != $GLOBALS[$this->offset])

                        {

                            $return .= " <a href=\"$GLOBALS[PHP_SELF]?$this->offset=$this->theNext$this->_get_vars&$this->valor\" class=\"num-activo\"> ";

                            if ($this->number_type == 'alpha')

                            {

                                 if($_ss_k>0)

                                 {

                                    $theLink = chr(64 + ($_ss_k));

                                    for($b = 0; $b < $_ss_k; $b++)

                                    {

                                       $theLink .= chr(64 + ($this->theNext%26)+1);

                                    }

                                    $return .= $theLink;

                                 } else {

                                 $return .= chr(64 + ($this->a));

                                 }

                            } else {

                                $return .= $this->a;

                            }
							if ($this->a == $egp) {
                            $return .= "</a> ";
							} else {
							$return .= "</a><span class='A'>  </span>";
							}
                        } else {

                            if ($this->number_type == 'alpha')

                            {

                                 if($_ss_k>0)

                                 {

                                    $theLink = chr(64 + ($_ss_k));

                                    for($b = 0; $b < $_ss_k; $b++)

                                    {

                                       $theLink .= chr(64 + ($this->theNext%26)+1);

                                    }

                                    $return .= $theLink;

                                 } else {

                                 $return .= chr(64 + ($this->a));

                                 }

                            } else {
							    if ($this->a == $egp) {
								$return .="<span class='num'>";
                                $return .= $this->a;
								$return .="</span> ";
								} else {
								$return .="<span class='num'>";
                                $return .= $this->a;
								$return .="</span>  ";								
								}
                            }

                            $return .= ($this->a < $this->num_pages) ? " $separator " : " ";

                        }

                    }

                    $this->theNext = $GLOBALS[$this->offset] + $this->limit;

                    if (!empty($fwd)) {

                        $offset_end = ($this->num_pages-1)*$this->limit;

//                      $return .= ($GLOBALS[$this->offset] + $this->limit < $this->total_result) ? "$separator <a href=\"$GLOBALS[PHP_SELF]?$this->offset=$this->successivo$this->_get_vars\" $this->theClass>$fwd</a> [<a href=\"$GLOBALS[PHP_SELF]?$this->offset=$offset_end$this->_get_vars\" $this->theClass>$ffwd</a>]" : "$separator $fwd [$ffwd]";

                        $return .= ($GLOBALS[$this->offset] + $this->limit < $this->total_result) ? "<a href=\"$GLOBALS[PHP_SELF]?$this->offset=$this->successivo$this->_get_vars\" class=\"flechas\">$fwd</a>" : "<a class=\"flechas\">$fwd</a>";

                    }
                }

            }

            return $return;

        }



        function show_info() // [Function : Showing the Information for the Offset]

        {

           if($GLOBALS[$this->offset] >= $this->total_result || $GLOBALS[$this->offset] < 0) return false;

            $return .= $this->total_result . " Total Results<br>";

            $_from = $GLOBALS[$this->offset] + 1;

            $GLOBALS[$this->offset] + $this->limit >= $this->total_result ? $_to = $this->total_result : $_to = $GLOBALS[$this->offset] + $this->limit;

            return $return;

        }
        function show_info2() // [Function : Showing the Information for the Offset]

        {

           if($GLOBALS[$this->offset] >= $this->total_result || $GLOBALS[$this->offset] < 0) return false;

            $return .= $this->total_result . " ";

            $_from = $GLOBALS[$this->offset] + 1;

            $GLOBALS[$this->offset] + $this->limit >= $this->total_result ? $_to = $this->total_result : $_to = $GLOBALS[$this->offset] + $this->limit;



            return $return;

        }
    }

?>