<li onclick="url = $(this).attr('value');$('.recipient-wrapper').load(url +' #recipient');$('.wrapper-messages').load(url + ' #messages');$('#sendMessageForm').show();$('.friends-wrapper').load(url + ' .friend-list');" class="getchat {ACTIVE_CHAT} cursor-ponter p-2" value="{USER_LINK}">
	<a class="d-flex justify-content-between"">
		<div class="text-small">
			<strong>{NAME}</strong>
			<p class="last-message text-muted">{LAST_MESSAGE}</p>
		</div>
		<div class="chat-footer">
			<p class="text-smaller text-muted mb-0">{TIME}</p>
			{NOT_READED}
		</div>
	</a>
</li>