<?
/*
   ABi Template
   
   written by Arturas Bajarkevicius
   
   from ABi Group
   http://www.abigroup.lt
*/
class ABiTemplate {

   var $vars =  array();
   var $output = '';
   
   function assign($name,$val)
   {
      $this->vars[$name] = $val;
   }
   
   function get($name)
   {
      if(isset($this->vars[$name])) 
      return $this->vars[$name];
      return '';
   }

   function parse($template)
   {
      $code = file_get_contents($template);
      $parser = new ABiT_Parser($this);
      $parser->parse($code);
      $this->output = $parser->getOutput();
   }  
   
   function getOutput()
   {
      return $this->output;
   }
   
}

class ABiT_Loop {
   var $output;
   var $code;   
   var $template;
   
   
   function ABiT_Loop($template,$code)
   {
      $this->code = $code;
      $this->template = $template;
   }
   
   function parse($variable)
   {
      $vars = $this->template->get($variable);
      $this->output = '';
      $code = $this->code;
      foreach ($vars as $var)
      {
         foreach ($var as $k => $v)
         {
            $this->template->assign(':abi_'.$variable.'.'.$k,$v);
         }
      
         $parser = new ABiT_Parser($this->template,$code);
         $parser->parse();
         $tmp_code = $parser->getOutput();
         
         // Parse loop vars
         $pattern = '/<\{\_([^\}]*)\}>/';
         preg_match_all($pattern,$tmp_code,$matches);
         
      
         $chg = array();
         foreach($matches[1] as $l)
         {
         
            $chg['<{_'.$l.'}>'] = $this->template->get(':abi_'.$l);
         }
         
         $tmp_code = strtr($tmp_code,$chg);
     
         $this->output .= $tmp_code;
      }
   }
   
   function getOutput()
   {
      return $this->output;
   }
   
}

class ABiT_Parser {      
   var $output;
   var $template;
   var $code;
   
   function ABiT_Parser ($template, $code = false)
   {
      $this->template = $template;
      if ($code) $this->code = $code;
   }
   
   function parse($code = false)
   {
      if (!$code) $code = $this->code;
   
   // LOOPS PARSING
      $pattern = '/<\{\%([^\}]*)\}>/';
      preg_match_all($pattern,$code,$matches);
      
      foreach ($matches[1] as $mt)
      {
      
         $v = $mt;
         
         $tmt = explode('<{%'.$mt.'}>',$code);
         if(count($tmt)>1)
         {
         $tmt = explode('<{/%'.$mt.'}>',$tmt[1]);
         $tmt = $tmt[0];
         
            $loop = new ABiT_Loop($this->template,$tmt);
            $loop->parse($v);
            $tmt2 = $loop->getOutput();
         
            $code = strtr($code, array('<{%'.$mt.'}>'.$tmt.'<{/%'.$mt.'}>' => $tmt2));         
         }
         
      }
      
      //  VAR PARSING
      $pattern = '/<\{\$([^\}]*)\}>/';
      preg_match_all($pattern,$code,$matches);      
      foreach($matches[1] as $l)
      {
         $vars['<{$'.$l.'}>'] = $this->template->get($l);
      }
      
      if(isset($vars))$code = strtr($code,$vars);      
      
      $this->output = $code;
   }
   
   function getOutput()
   {
      return $this->output;
   }
   
}
?>