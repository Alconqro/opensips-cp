<?php
/*
 * Copyright (C) 2022 OpenSIPS Solutions
 *
 * This file is part of opensips-cp, a free Web Control Panel Application for 
 * OpenSIPS SIP server.
 *
 * opensips-cp is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * opensips-cp is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

$config->dispatcher = array(
    "results_per_page" => array(
		"default" => 25,
		"name"    => "Results per page",
		"tip"    => "Number of results per page",
		"type"    => "number",
		"validation_regex" => "^[0-9]+$",
	),
	"results_page_range" => array(
		"default" => 10,
		"name"    => "Results page range",
		"tip"    => "Control over the pagination when displaying the dispatcher destinations",
		"type"    => "number",
		"validation_regex" => "^[0-9]+$",
    ),
    "table_dispatcher" => array(
        "default" => "dispatcher",
        "name" => "Table Dispatcher",
        "type" => "text",
		"tip"  => "The database table name for storing the dispatcher data"
    ),
	"talk_to_this_assoc_id" => array(
		"default" => 1,
		"name"    => "Talk to this assoc id",
		"options" => get_assoc_id(),
		"type"    => "dropdown",
		"tip"	  => "As OCP can manage multiple OpenSIPS instances, this is the association 
		ID pointing to the group of servers (system) which needs to be provision with this dispatching information."
	),
    "status" => array(
        "default" => array('Active'=>'Active','Inactive'=>'Inactive','Probing'=>'Probing'),
        "name" => "Status",
        "type" => "json"
    )
    );