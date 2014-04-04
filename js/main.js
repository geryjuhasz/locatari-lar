//Fixes
jQuery.browser={};(function(){jQuery.browser.msie=false;
jQuery.browser.version=0;if(navigator.userAgent.match(/MSIE ([0-9]+)\./)){
jQuery.browser.msie=true;jQuery.browser.version=RegExp.$1;}})();

$.fn.classList = function() { return this[0].className.split(/\s+/); };
if (!window.location.origin) {
	window.location.origin = window.location.protocol + "//" + window.location.hostname;
}

tinymce.init({
	selector: "textarea.tinymce",
	plugins: [
	"advlist autolink lists link image charmap print preview anchor",
	"searchreplace visualblocks code fullscreen",
	"insertdatetime media table contextmenu paste jbimages"
	],
	toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | jbimages",
	relative_urls: false,
	width: 750
});

$(document).ready(function() {
	//Fixes
	$('div.pagination > ul').each(function onEachPaginator (i, item) {
    $(item).addClass('pagination').parent().removeClass('pagination');
	});
	//jQuery init
		$('#ads-filter input[name=date_begin]').datepicker({
		onClose: function( selectedDate ) {
			$('#ads-filter input[name=date_end]').datepicker( "option", "minDate", selectedDate );
		}
	});
	$('#ads-filter input[name=date_end]').datepicker({
		onClose: function( selectedDate ) {
			$('#ads-filter input[name=date_begin]').datepicker( "option", "maxDate", selectedDate );
		}
	});
	//Utilities
	$('.btn-confirm').click(function() {
		if(!confirm('Are you sure?')) return false;
	});
	$('.page-specifier').change(function() {
		var value = $(this).val();
		var name = $(this).attr('name');
		var newUrl = location.origin + location.pathname + '?' + name + '=' + value;
		document.location = newUrl;
	});
	$('.btn-confirm-submit').click(function() {
		if(!confirm('Are you sure you want to delete this record?')) {
			return false;
		}
	});
	$('.btn-force-delete').click(function() {
		if(!confirm('Are you sure you want to delete this record?')) {
			return false;
		}
		var $form = $(this).parents('form');
		var url = $(this).data('url');
		$form.attr('action', url);
		$form.children('input[name=_method]').val('DELETE');
		$form.submit();
	});
	$('.check-all').click(function() {
		var $rows = $(this).siblings('table').find('tbody tr');
		$rows.each(function() {
			console.log($(this).children().first().find('input[type="checkbox"]'));
			$(this).children().first().find('input[type="checkbox"]').prop('checked', true);
		});
	});
	$('.uncheck-all').click(function() {
		var $rows = $(this).siblings('table').find('tbody tr');
		$rows.each(function() {
			$(this).children().first().find('input[type="checkbox"]').prop('checked', false);
		});
	});
	$('.delete-one').click(function() {
		if(!confirm('Are you sure you want to delete this record?')) {
			return false;
		}
		var $row = $(this).parents('tr').children();
		$row.first().find('input[type=checkbox]').prop('checked', 'true');
		$(this).parents('form').submit();
	});
	$('.delete-all').click(function() {
		var $checked = $(this).siblings('table').find('tbody tr input[type=checkbox]:checked');
		if(!$checked.length) return;
		var form = $(this).parents('form');
		if(!confirm('Are you sure you want delete all selected records?')) {
			return false;
		}
		form.submit();
	});
	$('*[class*= delete-prop-]').click(function() {
		var $checked = $(this).siblings('table').find('tbody tr input[type=checkbox]:checked');
		if(!$checked.length) return;
		var form = $(this).parents('form');
		var classes = $(this).classList();
		var property;
		for(var i = 0, len = classes.length; i < len; i++) {
			if(classes[i].indexOf('delete-prop-') == 0) {
				var tokens = classes[i].split('-');
				property = tokens[tokens.length - 1];
				break;
			}
		}
		form.append($('<input name="delete_property" type="hidden" value="image">'));
		if(!confirm('Are you sure you want to delete all selected records \'' +  property +  '\' field ?')) {
			return false;
		}
		form.submit();
	});
	
	//Functionality
	
	//Ads
	$('#ad-view-history').click(function() {
		var url = urls['adsController'] + '/' + $(this).attr('value') + '/history';
		var historyWindow = window.open(url, 'history', 'height=500, width=700');
		if(window.focus) historyWindow.focus();
	});
	$('#ad-change-user').click(function() {
		var url = urls['usersController'] + '/select';
		var usersWindow = window.open(url, 'usersSelect', 'height=500, width=700');
		if(window.focus) usersWindow.focus();
	});
	$('#ad-view-reports').click(function() {
		var url = urls['reportsController'] + '/' + $(this).attr('value') + '/ad';
		var reportsWindow = window.open(url, 'adReports', 'height=500, width=700');
		if(reportsWindow.focus) reportsWindow.focus();
	});
	
	//Users
	$('ul.sales').hide();
	$('ul.buys').hide();
	$('a.sales').click(function() {
		$(this).parents('td').children('ul.buys').hide();
		$(this).parents('td').children('ul.sales').toggle('blind', function() {
			if($(this).css('display') === 'none') {
				$(this).find('.users-toggleable').each(function() {
					$(this).hide();
				});
			}
		});
	});
	$('a.buys').click(function() {
		$(this).parents('td').children('ul.sales').hide();
		$(this).parents('td').children('ul.buys').toggle('blind', function() {
			if($(this).css('display') === 'none') {
				$(this).find('.users-toggleable').each(function() {
					$(this).hide();
				});
			}
		});
	});
	
	$('div.ad-questions').hide();
	$('div.ad-offers').hide();
	$('table.ad-offers-list').hide();
	
	$('a.ad-questions').click(function() {
		$(this).parents('li').children('div.ad-offers').hide();
		$(this).parents('li').children('div.ad-questions').toggle('blind', function() {
			if($(this).css('display') === 'none') {
				$(this).find('.users-toggleable').each(function() {
					$(this).hide();
				});
			}
		});
	});
	$('a.ad-offers').click(function() {
		$(this).parents('li').children('div.ad-questions').hide();
		$(this).parents('li').children('div.ad-offers').toggle('blind', function() {
			if($(this).css('display') === 'none') {
				$(this).find('.users-toggleable').each(function() {
					$(this).hide();
				});
			}
		});
	});
	$('a.ad-offers-list').click(function() {
		$(this).parents('li').siblings('li').find('.users-toggleable').hide();
		$(this).parents('li').children('table.ad-offers-list').toggle('blind');
	});
	$('.users-ad-delete').click(function() {
		var $self = $(this);
		if(!confirm('Delete ad?')) return false;
		var id = $(this).parent().children('input[type=hidden]').val();
		$.ajax(urls['adsController'] + '/ajaxDelete', {
			method: 'POST',
			data: {
				'_method': 'DELETE',
				'type': 'ad',
				'id': id
			},
			complete: function(response) {
				var data = $.parseJSON(response.responseText);
				var badge = $self.parents('li').parents('td').first().find('span.users-ads-count');
				if(data.success) {
					badge.html(parseInt(badge.html())- 1);
					$self.parents('li').first().hide('fast', function() { $(this).remove() });
				} else {
					alert('An error has occurred.');
				}
			}
		});
	});
	$('.users-ad-offerlist-delete').click(function() {
		var $self = $(this);
		if(!confirm('Delete offers?')) return false;
		var id = $(this).parent().children('input[type=hidden]').val();
		$.ajax(urls['adsController'] + '/ajaxDelete', {
			method: 'POST',
			data: {
				'_method': 'DELETE',
				'type': 'adofferlist',
				'id': id
			},
			complete: function(response) {
				var data = $.parseJSON(response.responseText);
				var badge = $self.parents('li').parents('li').first().find('span.users-ad-offerlists-count');
				if(data.success) {
					badge.html(parseInt(badge.html())- 1);
					$self.parents('li').first().hide('fast', function() { $(this).remove() });
				} else {
					alert('An error has occurred.');
				}
			}
		});
	});
	$('.users-ad-offer-delete').click(function() {
		var $self = $(this);
		if(!confirm('Delete offer?')) return false;
		var id = $(this).parent().children('input[type=hidden]').val();
		$.ajax(urls['adsController'] + '/ajaxDelete', {
			method: 'POST',
			data: {
				'_method': 'DELETE',
				'type': 'adoffer',
				'id': id
			},
			complete: function(response) {
				var data = $.parseJSON(response.responseText);
				var badge = $self.parents('tr').parents('li').first().find('span.users-ad-offers-count');
				if(data.success) {
					badge.html(parseInt(badge.html())- 1);
					$self.parents('tr').first().hide('fast', function() { $(this).remove() });
				} else {
					alert('An error has occurred.');
				}
			}
		});
	});
	$('.users-ad-question-delete').click(function() {
		var $self = $(this);
		if(!confirm('Delete message?')) return false;
		var id = $(this).parent().children('input[type=hidden]').val();
		$.ajax(urls['adsController'] + '/ajaxDelete', {
			method: 'POST',
			data: {
				'_method': 'DELETE',
				'type': 'adquestion',
				'id': id
			},
			complete: function(response) {
				var data = $.parseJSON(response.responseText);
				var badge = $self.parents('tr').parents('li').first().find('span.users-ad-questions-count');
				if(data.success) {
					badge.html(parseInt(badge.html())- 1);
					$self.parents('tr').first().hide('fast', function() { $(this).remove() });
				} else {
					alert('An error has occurred.');
				}
			}
		});
	});
	//Admin page
	$('#admins-select-admin').change(function() {
		var type = $(this).val();
		$('#admins-select-country').hide();
		$('#admins-select-rights').hide();
		if(type == 'admin') {
			$('#admins-select-country').show();
		} else if(type == 'editor') {
			$('#admins-select-rights').show();
			$('#admins-select-country').show();
		}
	});
	$('#admins-select-admin').change();
});