$(document).ready(function() {

	const reShow = () => {

		$('.sender').show();

	}

	const secMsg = (val="NULL") => {

		eingabe = confirm("Sicherheitsabfrage!\n\nAktion: " + val + "\n\nWollen Sie die Aktion wirklich ausführen?");
		return eingabe;

	}

	const clearHosts = () => {

		$(".websitemenu").each(function () {

			$(this).html( $(this).attr('action') );
			$(this).attr('name',$(this).attr('newname'));

		});

	}

	$(".viewport").height( $(window).height() - 50 );

	$(".critical").click(function () {

	 return secMsg($(this).attr('title'));

	});



	$('.sender').click(function() {

			$(this).hide();
			setTimeout(reShow, 3000);

	});

	$(".tag").click(function () {

	 $(this).select();
	 document.execCommand('copy');

	});

	$(".hiddenaction").click(function () {

	 /*
	  *	token -> Form action / token name
		* name -> object id (websiteid, cookieid, comanyid, categoryid)
		* action -> Form routing to url
		* alert -> prompt security message
		*/

	 let tokenclass = '#' + $(this).attr('token');
	 let secmsg = $(this).attr('alert');
	 $('.hiddenactionid').val( $(this).attr('name') );
	 $('.hiddenactions').attr( 'action', $(this).attr('action') );
	 $('.hiddenactiontoken').val( $(tokenclass).attr('token') );

	 if(secmsg){

		 if(secMsg(secmsg) === true){

			 $('.hiddenactions').submit();

		 }

		 return false;

	 }

	 $('.hiddenactions').submit();
	 return false;

	});

	$(".websitemenu").click(function () {

		if($(this).attr('name')!='0'){

		 clearHosts();

		 let hostname = $(this).attr('action');
		 $(this).html( $('.hostnameupdateform').html() );
		 $('.hostnametoupdate').val( hostname );
		 $('.websitesid').val( $(this).attr('name') );
		 $(this).attr('name','0');
		 $('.hostnametoupdate').focus();

	 }

	});

});
