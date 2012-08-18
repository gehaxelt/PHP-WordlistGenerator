<?php
include_once 'exceptions.wordlistgenerator.class.php';

class WordlistGenerator {
	
	private $charset = '';
	private $word = array();
	
	/**
	 * Constructor of BruteForce
	 * @param int $startLength - Length of the words. Default value: 2
	 * @param string $charset - Charset to be used. Default value: 0123456789
	 * @throws StartLengthToShortException - if $startLength equals or is less than 1
	 */
	public function __construct($startLength=2,$charset='0123456789') {
		
		if(!is_int($startLength))
			throw new NotAnIntegerException('$startLength is not an integer');
		
		if($startLength<=1)
			throw new StartLengthTooShortException('$startlength is less or equals 1');
		
		if(!is_string($charset))
			throw new NotAStringException('$charset is not a string.');
		
		$this->setCharSet($charset);
		$this->initWord($startLength);
		
	}
	
	/**
	 * Initiates the $this->word array with the first character of $this->charset
	 * @param int $ArrayLength - Length of array to initiate
	 */
	private function initWord($ArrayLength) {
		
		for($i = 0;$i<$ArrayLength;$i++)
			$this->word[$i]=$this->charset[0];
	}
	
	/**
	 * Checks whether next words are avaiable.
	 * @return boolean - true if there are next words. False if not.
	 */
	public function isNext() {
		$flag =true;
		$charsetlength=strlen($this->charset);
		$charsetlength--;
		
		for($i=0;$i<count($this->word);$i++)
			$flag &=($this->word[$i]==$this->charset[$charsetlength]); //go through the array and check whether every index equals the last charset character
		
		return !$flag;

	}
	
	/**
	 * Generates recursivly the next word.
	 */
	public function nextWord() {
		$this->RecursiveIncrease(count($this->word)-1); //Start recursive increase from the last index
	}
	
	/**
	 * Increases the given position 
	 * @param int $position
	 */
	private function RecursiveIncrease($position) {
		$charsetlength=strlen($this->charset);
		$charsetlength--;
		if($this->word[$position]!=$this->charset[$charsetlength]) 
		{
			//no need to increase $this->word[$position+1] so return 
			$this->word[$position]=$this->charset[strpos($this->charset,$this->word[$position])+1];
			return;
		} else {
			//reset the current $position and increase $position+1
			$this->word[$position]=$this->charset[0];
			$this->RecursiveIncrease($position-1);
			return;
		}
	}
	
	/**
	 * Set the charset used for word generation. The current word(s) will be resetted.
	 * @param string $charSet - Charset to use for word generation
	 * @throws NotAStringException - if $charSet is not a string.
	 */
	public function setCharSet($charSet) {
		if(!is_string($charSet))
			throw new NotAStringException('$charSet is not a string.');
		$this->charset=$charSet;
		$this->resetWord();
	}
	
	/**
	 * Returns the current charset.
	 * @return string - the current charset.
	 */
	public function getCharSet() {
		return $this->charset;
	}
	
	/**
	 * Reset the word to its default value
	 */
	public function resetWord() {
		$this->initWord(count($this->word));
	}
	
	/**
	 * Returns the current word
	 * @return string of current word
	 */
	public function getWord() {
		return implode('',$this->word);
	}
}
?>
