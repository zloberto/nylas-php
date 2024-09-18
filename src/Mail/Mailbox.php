<?php

namespace Zloberto\Nylas\Mail;

use Zloberto\Nylas\Auth\Grant;
use Zloberto\Nylas\Mail\Enums\Fields;

/**
 * Abstract class representing a Mailbox in Nylas SDK.
 */
abstract class Mailbox
{
	/**
	 * @var Grant Authorization grant used for accessing mailbox data.
	 */
	protected Grant $grant;

	/**
	 * Retrieve a list of messages with optional filters.
	 *
	 * @param int|null $limit The number of messages to return. Default is 50.
	 * @param string|null $page_token Token for pagination.
	 * @param string|null $select Fields to select.
	 * @param string|null $subject Filter by subject.
	 * @param string|null $any_email Search across any email address fields.
	 * @param string|null $to Filter by recipient's email address.
	 * @param string|null $from Filter by sender's email address.
	 * @param string|null $cc Filter by CC'd email addresses.
	 * @param string|null $bcc Filter by BCC'd email addresses.
	 * @param string|null $in Filter by folder or label.
	 * @param bool|null $unread Filter by unread status.
	 * @param bool|null $starred Filter by starred status.
	 * @param string|null $thread_id Filter by thread ID.
	 * @param int|null $received_before Filter by messages received before a specific timestamp.
	 * @param int|null $received_after Filter by messages received after a specific timestamp.
	 * @param Fields|null $fields Object representing the fields to return.
	 * @param string|null $search_query_native Native search query.
	 * @return mixed
	 */
	abstract public function getAllMessages(
		?int $limit = 50,
		?string $page_token = null,
		?string $select = null,
		?string $subject = null,
		?string $any_email = null,
		?string $to = null,
		?string $from = null,
		?string $cc = null,
		?string $bcc = null,
		?string $in = null,
		?bool $unread = null,
		?bool $starred = null,
		?string $thread_id = null,
		?int $received_before = null,
		?int $received_after = null,
		?Fields $fields = null,
		?string $search_query_native = null,
	);

	/**
	 * Retrieve a specific message by its ID.
	 *
	 * @param string $message_id The ID of the message.
	 * @param Fields|null $fields Object representing the fields to return.
	 * @param string|null $select Fields to select.
	 * @return mixed
	 */
	abstract public function getMessage(
		string $message_id,
		?Fields $fields = null,
		?string $select = null,
	);

	/**
	 * Update the attributes of a specific message.
	 *
	 * @param string $message_id The ID of the message to update.
	 * @param string|null $select Fields to select.
	 * @param bool|null $starred Set whether the message is starred.
	 * @param bool|null $unread Set whether the message is unread.
	 * @return mixed
	 */
	abstract public function updateMessageAttributes(
		string $message_id,
		?string $select = null,
		?bool $starred = null,
		?bool $unread = null,
	);

	/**
	 * Send a message.
	 *
	 * @param string $subject The subject of the message.
	 * @param string $body The body content of the message.
	 * @param array $from The sender's email address.
	 * @param array $to The recipient's email address.
	 * @param array|null $cc CC recipients.
	 * @param array|null $bcc BCC recipients.
	 * @param array|null $reply_to Reply-to email addresses.
	 * @param array|null $tracking_options Options for tracking opens and clicks.
	 * @param int|null $send_at Timestamp when the message should be sent.
	 * @param string|null $reply_to_message_id ID of the message being replied to.
	 * @param bool|null $use_draft Whether to send from a draft.
	 * @param array|null $attachments Attachments for the message.
	 * @param array|null $custom_headers Custom headers for the message.
	 * @return mixed
	 */
	abstract public function sendMessage(
		string $subject,
		string $body,
		array $from,
		array $to,
		?array $cc = null,
		?array $bcc = null,
		?array $reply_to = null,
		?array $tracking_options = null,
		?int $send_at = null,
		?string $reply_to_message_id = null,
		?bool $use_draft = null,
		?array $attachments = null,
		?array $custom_headers = null,
	);

	/**
	 * Retrieve all scheduled messages.
	 *
	 * @return mixed
	 */
	abstract public function getScheduledMessages();

	/**
	 * Retrieve a specific scheduled message by its schedule ID.
	 *
	 * @param string $schedule_id The schedule ID of the message.
	 * @return mixed
	 */
	abstract public function getScheduledMessage(
		string $schedule_id,
	);

	/**
	 * Cancel a scheduled message.
	 *
	 * @param string $schedule_id The schedule ID of the message to cancel.
	 * @return mixed
	 */
	abstract public function cancelScheduledMessage(
		string $schedule_id,
	);
}
