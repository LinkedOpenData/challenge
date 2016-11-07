//
// SPARQL Timeliner �p�J�X�^�}�C�Y
// 2014.02.01

//
// recline.View.Timeline
// Timeline JS 2.26 �Ή�

recline.View.Timeline.prototype._initTimeline = function() {
	var data = this._timelineJSON();
	var config = this.state.get("timelineJSOptions");
	config.id = this.elementId;
	// Timeline JS 2.26.5 �Ή�
	config.source = data;
	
	this.timeline.init(config, data);
	this._timelineIsInitialized = true;
};


//
// recline.View.Map
// Leaflet 0.7.2 �Ή�
// 

recline.View.Map.prototype._setupMap = function(){
    var self = this;
    this.map = new L.Map(this.$map.get(0));
    
    //var mapUrl = "http://otile{s}.mqcdn.com/tiles/1.0.0/osm/{z}/{x}/{y}.png";
    var mapUrl = "http://j.tile.openstreetmap.jp/{z}/{x}/{y}.png";
    //var osmAttribution = 'Map data &copy; 2011 OpenStreetMap contributors, Tiles Courtesy of <a href="http://www.mapquest.com/" target="_blank">MapQuest</a> <img src="http://developer.mapquest.com/content/osm/mq_logo.png">';
    var osmAttribution = 'Map data &copy; OpenStreetMap contributors, Tiles Courtesy of <a href="http://osm.jp/" target="_blank">OpenStreetMap Japan</a>';
    var bg = new L.TileLayer(mapUrl, {maxZoom: 18, attribution: osmAttribution ,subdomains: '1234'});
    this.map.addLayer(bg);

    this.markers = new L.MarkerClusterGroup(this._clusterOptions);

    // rebind this (as needed in e.g. default case above)
    this.geoJsonLayerOptions.pointToLayer =  _.bind(
        this.geoJsonLayerOptions.pointToLayer,
        this);
    this.features = new L.GeoJSON(null, this.geoJsonLayerOptions);

// Leaflet 0.7.2 �΍�
// �ȉ��������Ă���ƁA�\�������������Ȃ邱�Ƃ�����B
//    this.map.setView([0, 0], 2);

    this.mapReady = true;
};
