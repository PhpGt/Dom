<?php
namespace Gt\Dom;

/**
 * Represents textual notations within markup; although it is generally not
 * visually shown, such comments are available to be read in the source view.
 * Comments are represented in HTML and XML as content between '<!--' and '-->'.
 */
class Comment extends \DOMComment {}