<?php
if(!class_exists('StartLengthTooShortException'))
{
	class StartLengthTooShortException extends Exception{}			
}

if(!class_exists('NotAStringException'))
{
	class NotAStringException extends Exception{}
}

if(!class_exists('NotAnIntegerException'))
{
	class NotAnIntegerException extends Exception{}
}