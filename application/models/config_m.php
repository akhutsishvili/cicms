<?php
class Config_m extends CI_Model {

	function config_to_json(){
	    $arr =  $this->config->item('config');
	    $tarr = '{"options":{"uploads_dir":"..\/uploads"},"tables":{"about":{"label":"\u10e9\u10d5\u10d4\u10dc \u10e8\u10d4\u10e1\u10d0\u10ee\u10d4\u10d1","icon":"glyphicon glyphicon-tower"},"categories":{"label":"\u10d9\u10d0\u10e2\u10d4\u10d2\u10dd\u10e0\u10d8\u10d4\u10d1\u10d8","icon":"glyphicon glyphicon-tower"},"brands":{"label":"\u10d1\u10e0\u10d4\u10dc\u10d3\u10d4\u10d1\u10d8","icon":"glyphicon glyphicon-tower"},"cities":{"label":"\u10e5\u10d0\u10da\u10d0\u10e5\u10d4\u10d1\u10d8","icon":"glyphicon glyphicon-tower"},"comments":{"label":"\u10d9\u10dd\u10db\u10d4\u10dc\u10e2\u10d0\u10e0\u10d4\u10d1\u10d8","icon":"glyphicon glyphicon-tower"},"contact":{"label":"\u10d9\u10dd\u10dc\u10e2\u10d0\u10e5\u10e2\u10d8","icon":"glyphicon glyphicon-tower"},"items":{"label":"\u10d9\u10d0\u10e2\u10d0\u10da\u10dd\u10d2\u10d8","icon":"glyphicon glyphicon-tower"},"promocodes":{"label":"\u10de\u10e0\u10dd\u10db\u10dd \u10d9\u10dd\u10d3\u10d4\u10d1\u10d8","icon":"glyphicon glyphicon-tower"},"orders":{"label":"\u10e8\u10d4\u10d9\u10d5\u10d4\u10d7\u10d4\u10d1\u10d8","icon":"glyphicon glyphicon-tower"}},"about":{"id":{"type":"hidden","label":"id","visible":true},"body_geo":{"type":"textarea","label":"\u10e5\u10d0\u10e0\u10d7","visible":true},"body_eng":{"type":"textarea","label":"\u10d8\u10dc\u10d2","visible":false},"body_rus":{"type":"textarea","label":"\u10e0\u10e3\u10e1","visible":false}},"contact":{"id":{"type":"hidden","label":"id","visible":true},"body_geo":{"type":"textarea","label":"\u10e5\u10d0\u10e0\u10d7","visible":true},"body_eng":{"type":"textarea","label":"\u10d8\u10dc\u10d2","visible":false},"body_rus":{"type":"textarea","label":"\u10e0\u10e3\u10e1","visible":false},"lat":{"type":"text","label":"lat","visible":true},"lng":{"type":"text","label":"lng","visible":true},"email":{"type":"text","label":"\u10d4\u10da-\u10e4\u10dd\u10e1\u10e2\u10d0","visible":true}},"categories":{"id":{"type":"hidden","label":"id","visible":true},"title_geo":{"type":"text","label":"\u10e1\u10d0\u10ee\u10d4\u10da\u10d8 \u10e5\u10d0\u10e0\u10d7","visible":true},"title_eng":{"type":"text","label":"\u10e1\u10d0\u10ee\u10d4\u10da\u10d8 \u10d8\u10dc\u10d2","visible":true},"title_rus":{"type":"text","label":"\u10e1\u10d0\u10ee\u10d4\u10da\u10d8 \u10e0\u10e3\u10e1","visible":true},"filters":{"type":"text","label":"\u10e4\u10d8\u10da\u10e2\u10e0\u10d4\u10d1\u10d8","visible":false}},"brands":{"id":{"type":"hidden","label":"id","visible":true},"title_geo":{"type":"text","label":"\u10e1\u10d0\u10ee\u10d4\u10da\u10d8 \u10e5\u10d0\u10e0\u10d7","visible":true},"title_eng":{"type":"text","label":"\u10e1\u10d0\u10ee\u10d4\u10da\u10d8 \u10d8\u10dc\u10d2","visible":true},"title_rus":{"type":"text","label":"\u10e1\u10d0\u10ee\u10d4\u10da\u10d8 \u10e0\u10e3\u10e1","visible":true},"catecoryID":{"type":"dropdown","relation":"categories","relation_column":"title_geo","label":"\u10d9\u10d0\u10e2\u10d4\u10d2\u10dd\u10e0\u10d8\u10d0","visible":true}},"cities":{"id":{"type":"hidden","label":"id","visible":true},"title_geo":{"type":"text","label":"\u10e1\u10d0\u10ee\u10d4\u10da\u10d8 \u10e5\u10d0\u10e0\u10d7","visible":true},"title_eng":{"type":"text","label":"\u10e1\u10d0\u10ee\u10d4\u10da\u10d8 \u10d8\u10dc\u10d2","visible":true},"title_rus":{"type":"text","label":"\u10e1\u10d0\u10ee\u10d4\u10da\u10d8 \u10e0\u10e3\u10e1","visible":true}},"comments":{"id":{"type":"hidden","label":"id","visible":true},"name":{"type":"text","label":"\u10e1\u10d0\u10ee\u10d4\u10da\u10d8 \u10e5\u10d0\u10e0\u10d7","visible":true},"surname":{"type":"text","label":"\u10d2\u10d5\u10d0\u10e0\u10d8","visible":true},"body":{"type":"textarea","label":"\u10e2\u10d4\u10e5\u10e1\u10e2\u10d8","visible":true},"postID":{"type":"dropdown","relation":"items","relation_column":"title_geo","label":"\u10dc\u10d8\u10d5\u10d7\u10d8","visible":true}},"orders":{"id":{"type":"hidden","label":"id","visible":true},"trackingID":{"type":"text","label":"\u10e1\u10d0\u10d8\u10d3\u10d4\u10dc\u10d7\u10d8\u10e4\u10d8\u10d9\u10d0\u10ea\u10d8\u10dd \u10d9\u10dd\u10d3\u10d8","visible":true},"dateTime":{"type":"date","label":"\u10d7\u10d0\u10e0\u10d8\u10e6\u10d8","visible":true},"status":{"type":"dropdown","label":"\u10e1\u10e2\u10d0\u10e2\u10e3\u10e1\u10d8","list":{"a":"a","b":"b"},"visible":true},"userID":{"type":"dropdown","relation":"users","relation_column":"id","label":"\u10db\u10dd\u10db\u10ee\u10db\u10d0\u10e0\u10d4\u10d1\u10d4\u10da\u10d8","visible":true}}}';
		return pre(json_decode($tarr));

	}



}