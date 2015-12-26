{
	"kind": "calendar#events",
	"etag": "\"1451154074172000\"",
	"summary": "Recording Cowbell",
	"description": "",
	"updated": "{{ \Carbon\Carbon::now()->subHours(1)->format('Y-m-dTH:00:00+01:00') }}",
	"timeZone": "Europe/Stockholm",
	"accessRole": "reader",
	"defaultReminders": [],
	"items": [
		{
			"kind": "calendar#event",
			"etag": "\"2902308148132000\"",
			"id": "UNIQUE_UID",
			"status": "confirmed",
			"htmlLink": "https://calendar.google.com/calendar/event?eid=UNIQUE_EID",
			"created": "{{ \Carbon\Carbon::now()->subHours(1)->format('Y-m-dTH:00:00+01:00') }}",
			"updated": "{{ \Carbon\Carbon::now()->subHours(1)->format('Y-m-dTH:00:00+01:00') }}",
			"summary": "Event title",
			"description": "Event description",
			"location": "Event location",
			"creator": {
				"email": "mikael@jorhult.se"
			},
			"organizer": {
				"email": "bruce.dickinson@group.calendar.google.com",
				"displayName": "Recording Cowbell",
				"self": true
			},
			"start": {
				"dateTime": "{{ \Carbon\Carbon::now()->addHours(1)->format('Y-m-dTH:00:00+01:00') }}"
			},
			"end": {
				"dateTime": "{{ \Carbon\Carbon::now()->addHours(2)->format('Y-m-dTH:00:00+01:00') }}"
			},
			"iCalUID": "UNIQUE_UID@google.com",
			"sequence": 2
		}
	]
}