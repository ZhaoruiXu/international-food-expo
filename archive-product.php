<?php
/**
 * The template for redirecting shop page to the ticket product
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Food_Expo
 */

$ticket_page = get_permalink(44);
header('Location: ' . $ticket_page);