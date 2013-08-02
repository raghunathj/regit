<?php

/*
 * Project: Regit - Regular expression made simple for Developers
 * Author: Raghunath J <jrcbangalore@gmail.com>
 * Version: 1.0
*/

class RegIt{

	private $regexpression;
	private $prefix;
	private $suffix;
	private $overallexpression;

	/*
	 * Validate it as the beginning of everything
	*/

	public function begins(){
		if(!strpos($this->prefix,'^')){
			$this->prefix = '^'.$this->prefix;
		}
		return $this;
	}


	/*
	 * Should be a number
	*/
	public function isnumber(){
		return $this->make('[0-9]');
	}

	/*
	 * Should be a number
	*/
	public function isalphabet($input){
		
	}

	/*
	 * Can be anything / AlphaNumeric
	*/
	public function anything($input){
		
	}


	/*
	 * Match complete word
	*/
	public function matchWord(){

	}

	/*
	 * If its having a one or multiple number or not
	*/

	public function hasnumber($input = null){
		return $this->make('\d');
	}

	/*
	 * Just add the text
	 */

	public function then($input){
		return $this->make($this->escape($input));
	}

	/*
	 * Might have this
	*/

	public function mighthave($input){
		return $this->make($this->escape($input).'?');
	}


	/*
	 * Function helps in creating the regular expression
	*/
	public function make($regexpression){
		$this->regexpression .= $regexpression;
		return $this;
	}

	/*
	 * Return all prefix, tempExpression and suffix to create the final exp
	*/
	public function build(){
		$this->overallexpression = '/'.$this->prefix.$this->regexpression.$this->suffix.'/';
		return $this->overallexpression;
	}

	/*
	 * Validate the match and return true or false
	*/

	public function valid($exp,$input){
		if(preg_match($exp,$this->escape($input))){
			return true;
		}
		return false;
	}

	/*
	 * Sanitise the string that user puts for adding escape characters
	 * and not break the reg code
	*/

	public function escape($input){
		if($input instanceof Regit){
			//Dont check it as its already checked
			return $input;
		}

		//Make the input as string if not a string
		if(!is_string($input)){
			//Cast it to string
			$input = (string)$input;
		}

		$pattern = '/[^\w]/';
		$op = preg_replace_callback($pattern,function($found){
			return "\\".$found[0];
		}, $input);

		return $op;
	}



}