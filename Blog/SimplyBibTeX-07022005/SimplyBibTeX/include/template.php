<?php
/*
    An extremely simple template system that uses either
    <?php echo $var; ?>
    or
    <?=$var?>
    value placeholders.
*/
    class Template
    {
        var $file;
        var $content;
        var $output;
        var $cache_id;        
        var $expire;
        var $cached;
                
        function Template($template_file, 
			$cache_path = NULL, 
			$extension = null, 
			$expire = 900) 
		{
			
        	$this->cache_id  = $cache_path .'/cache.'. md5($template_file);			        	
        	$this->cache_id .= ($extension) ? md5($extension) : "";			         	
        	
            $this->file = $template_file;
            $this->expire = $expire;
        }
        
        function set($name, $value)
        {
        	$this->content[$name] = is_object($value) ? $value->fetch() : $value;            
        }
        
        /* brute force */
        function clear_cache()
        {
        	@unlink($this->cache_id);
		}       
        
        function is_cached() {
        
        	/* get info if this is cached */
	        if($this->cached) return true;
	
	        // Passed a cache_id?
	        if(!$this->cache_id) return false;
	
	        // Cache file exists?
	        if(!file_exists($this->cache_id)) return false;
	
	        // Can get the time of the file?
	        if(!($mtime = filemtime($this->cache_id))) return false;
	
	        // Cache expired?
	        if(($mtime + $this->expire) < time()) {
	            @unlink($this->cache_id);
	            return false;
	        }
	        else {
	            /**
	             * Cache the results of this is_cached() call.  Why?  So
	             * we don't have to double the overhead for each template.
	             * If we didn't cache, it would be hitting the file system
	             * twice as much (file_exists() & filemtime() [twice each]).
	             */
	            $this->cached = true;
	            return true;
	        }
	    }
	    
       function do_fetch_cache() {
	        if($this->is_cached()) {
	        
	            $fp = @fopen($this->cache_id, 'r');
	            $contents = fread($fp, filesize($this->cache_id));
	            fclose($fp);
	            return $contents;
	        } else {
	        
	            $contents = $this->do_fetch();	
	            // Write the cache
	            if($fp = @fopen($this->cache_id, 'w')) {
	                fwrite($fp, $contents);
	                fclose($fp);
	            }
	            else {
	                die('Unable to write cache.');
	            }
	            return $contents;
	        }
	    }
	    
        function do_fetch()
        {
            extract($this->content);
            ob_start();
            @include($this->file);
            $this->output = ob_get_contents();
            ob_end_clean();    
            
            return $this->output;
        }    
        
        function fetch($bypass = false)
        {
        	return ($bypass) ? $this->do_fetch() : $this->do_fetch_cache();
		}
        	
		function run($bypass = false)
		{
			echo $this->fetch($bypass);
		}    
    }
?>
