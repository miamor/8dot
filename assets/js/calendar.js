$(document).ready(function() {
//	sce();
	
		/* initialize the external events
		-----------------------------------------------------------------*/
	
//		$('#test-data').html($('#calendar').fullCalendar('clientEvents'));
	
		$('#external-events div.external-event').each(function() {
		
			// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
			// it doesn't need to have a start or end
			var eventObject = {
				id: $(this).attr('data-id'),
				title: $.trim($(this).text()), // use the element's text as the event title
				color: $(this).attr('data-bg'),
				textColor: $(this).attr('data-color'),
				url: $(this).attr('data-url'),
//				start: $(this).attr('data-start'),
//				end: $(this).attr('data-end'),
//				allday: $(this).attr('data-allday')
			};
			
			// store the Event Object in the DOM element so we can get to it later
			$(this).data('eventObject', eventObject);
			
			// make the event draggable using jQuery UI
			$(this).draggable({
				zIndex: 999,
				revert: true,      // will cause the event to go back to its
				revertDuration: 0  //  original position after the drag
			});
			
		});
	
		/* initialize the calendar
		-----------------------------------------------------------------*/
		
	
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		var calendar = $('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			selectable: true,
			selectHelper: true,
			select: function (start, end, allDay) {
				smallBoard($('.sb-newevent'));
				$('.sceditor-container iframe').contents().find('body').attr({
					'contenteditable' : true,
					'dir' : 'ltr'
				}).css('margin', '5px 3px');
				$('.start-event').val(start);
				$('.end-event').val(end);
				$('.form-new-event').submit(function () {
					$form = $(this);
					$.ajax({
						url: MAIN_URL + '/pages/schedule.php?do=addevent&act=submit',
						type: 'POST',
						data: $form.serialize(),
						datatype: 'json',
						success: function (data) {
							alert($form.serialize());
							$('#calendar').fullCalendar('refetchEvents');
							$('.sb-newevent').hide(300).prev().hide();
						},
						error: function (xhr) {
							mtip('', 'error', '', xhr+'. Please contact the administrators for help.')
						}
					});
					return false
				});
			},
			editable: true,
			eventSources: [{
				url: MAIN_URL + '/pages/schedule.data.php'
			}],
			eventDrop: function(event, delta, revertFunc) {
				if (!confirm(event.title + " was dropped on " + event.start.format() + " end at " + event.end.format() +". Are you sure about this change?")) {
					revertFunc();
				} else {
					$.ajax({
						url: MAIN_URL + '/pages/schedule.php?do=updateevent&id='+event.id+'&start='+event.start.format()+'&end='+event.end.format()+'&act=submit',
						type: 'POST',
//						data: event.start,
						datatype: 'json',
						success: function (data) {
							$('#calendar').fullCalendar('refetchEvents');
						},
						error: function (xhr) {
							mtip('', 'error', '', 'Something went wrong when the system trying to update your schedule. Please contact the administrators for help.')
						}
					});
				}
			},
/*			eventRender: function(event, element) {
				element.bind('dblclick', function() {
					alert('double click!');
				});
			},
*/			eventClick: function(event, jsEvent, view) {
				if (event.url) {
					window.open(event.url);
					return false;
				}
				$('.sb-editevent .form-edit-event').attr('id', event.id).load(MAIN_URL + '/pages/schedule.php?id='+event.id+' .form-edit-event > span', function () {
					smallBoard($('.sb-editevent')); flatApp(); sce()
				});
				$('a.act-edit-event').click(function () {
					act = $(this).attr('id');
					id = $(this).closest('.form-edit-event').attr('id');
					$.ajax({
						url: MAIN_URL + '/pages/schedule.php?do='+act+'event&id='+id+'&act=submit',
						type: 'POST',
						datatype: 'json',
						success: function (data) {
							$('#calendar').fullCalendar('refetchEvents');
							$('.sb-editevent').hide().prev().hide();
						},
						error: function (xhr) {
							mtip('', 'error', '', xhr+'. Please contact the administrators for help.')
						}
					})
				});
				$('.form-edit-event').submit(function () {
					id = $(this).attr('id');
					$.ajax({
						url: MAIN_URL + '/pages/schedule.php?do=editevent&id='+id+'&act=submit',
						type: 'POST',
						data: $(".form-edit-event").serialize(),
						datatype: 'json',
						success: function (data) {
							$('#calendar').fullCalendar('refetchEvents');
							$('.sb-editevent').hide().prev().hide();
						},
						error: function (xhr) {
							mtip('', 'error', '', xhr+'. Please contact the administrators for help.')
						}
					});
					return false
				})
			},
			eventResize: function(event, delta, revertFunc) {
				if (!confirm(event.title + " was set to start at " + event.start.format() + " end at " + event.end.format() +". Are you sure about this change?")) {
					revertFunc();
				} else {
					$.ajax({
						url: MAIN_URL + '/pages/schedule.php?do=updateevent&id='+event.id+'&start='+event.start.format()+'&end='+event.end.format()+'&act=submit',
						type: 'POST',
//						data: event.start,
						datatype: 'json',
						success: function (data) {
							$('#calendar').fullCalendar('refetchEvents');
						},
						error: function (xhr) {
							mtip('', 'error', '', 'Something went wrong when the system trying to update your schedule. Please contact the administrators for help.')
						}
					});
				}
			},
			droppable: true, // this allows things to be dropped onto the calendar !!!
			drop: function(date) { // this function is called when something is dropped
				// retrieve the dropped element's stored Event Object
				var originalEventObject = $(this).data('eventObject');
				var copiedEventObject = $.extend({}, originalEventObject);
				copiedEventObject.start = date;
				copiedEventObject.end = date;
				$.ajax({
					url: MAIN_URL + '/pages/schedule.php?do=dragevent&id='+originalEventObject.id+'&start='+copiedEventObject.start.format()+'T00:00:00&end='+copiedEventObject.end.format()+'T00:00:00&act=submit',
					type: 'POST',
					datatype: 'json',
					success: function (data) {
//					$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
						$('#calendar').fullCalendar('refetchEvents');
						if ($('#drop-remove').is(':checked')) $(this).remove();
					},
					error: function (xhr) {
						mtip('', 'error', '', 'Something went wrong when the system trying to update your schedule. Please contact the administrators for help.')
					}
				});
			}
		});
		
	});
