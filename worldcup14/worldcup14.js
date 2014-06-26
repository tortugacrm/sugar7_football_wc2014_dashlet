/*
 *  This file is part of 'Football World Cup 2014 Dashlet'.
 *
 *  'Football World Cup 2014 Dashlet' is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation.
 *
 *  'Football World Cup 2014 Dashlet' is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with 'Football World Cup 2014 Dashlet'.  If not, see http://www.gnu.org/licenses/gpl.html.
 *
 * Copyright 2014 Olivier Nepomiachty - All rights reserved.
 */
({
    plugins: ['Dashlet'],
    initDashlet: function () {
        if (this.meta.config) {
            var team = this.settings.get("team") || "FRA";
            this.settings.set("team", team);
            var todayorteam = this.settings.get("todayorteam") || "team";
            this.settings.set("todayorteam", todayorteam);
        }
        //this.model.on("change:name", this.loadData, this);
    },
    
    loadData: function (options) {
        var team;
        if (_.isUndefined(this.model)) {
            return;
        }
        team = this.settings.get('team') || 'FRA';
        todayorteam = this.settings.get('todayorteam') || 'team';
        arg='';
        purl = parent.location.href;
		baseurl = purl.substring(0,purl.indexOf('#'));
        if (todayorteam=='team') {
			if ((typeof team != 'undefined')) arg='?fifa_code='+team+'&';
		} else arg='?today=1';
        $.ajax({
            url: baseurl+'custom/clients/base/views/worldcup14/services/worldcup14_rest.php'+arg,
            dataType: 'json',
            success: function (data) {
                if (this.disposed) {
                    return;
                }
                parentThis=this;
				$.each(data, function(idx, obj) {
					obj.datetime = parentThis.formatDateUser(obj.datetime);
					obj.url = baseurl;
				});
                _.extend(this, data);
                this.render();
            },
            context: this,
            complete: options ? options.complete : null
        });
    },

    formatDateUser: function(dstr){
		if ((typeof(dstr)=='undefined') || (dstr=='')) return '';
		var year  = dstr.substr(0,4);
		var month = dstr.substr(5,2)-1;
		var day   = dstr.substr(8,2);
		var hour  = dstr.substr(11,2);
		var min   = dstr.substr(14,2);
		var tz    = parseInt(dstr.substr(23,3)); // hours
		var date_game = Date.UTC(year, month, day, hour, min, 0, 0);
		var current_tz = app.user.attributes.preferences.tz_offset_sec; // secs
		var date_game_local = new Date();
		date_game_local.setTime(date_game + current_tz*1000 - tz*3600*1000);
		return(
			//dstr + ', tz=' + tz + ', current_tz=' + current_tz + ', ' +
			app.date(date_game_local).formatUser(true)+' '
			+this.formatTimeUser(date_game_local.getUTCHours(),date_game_local.getUTCMinutes(),app.user.attributes.preferences.timepref)
		);
	},
	
	formatTimeUser: function(h,m,pref){
		var ampm = '';
		if (pref.charAt(0)=='h') {//12
			if (h>11) ampm='pm'; else ampm='am';
			if (h>12) h-=12;
		}
		m = '' + m;
		if (m.length==1) m = '0' + m;
		return(h + ':' + m + ampm);
	}
    
})
