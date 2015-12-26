BEGIN:VCALENDAR
PRODID:-//Google Inc//Google Calendar 70.9054//EN
VERSION:2.0
CALSCALE:GREGORIAN
METHOD:PUBLISH
X-WR-CALNAME:Recording Cowbell
X-WR-TIMEZONE:Europe/Stockholm
X-WR-CALDESC:
BEGIN:VEVENT
DTSTART:{{ \Carbon\Carbon::now()->addHours(1)->format('Ymd\TH0000\Z') }}
DTEND:{{ \Carbon\Carbon::now()->addHours(2)->format('Ymd\TH0000\Z') }}
DTSTAMP:{{ \Carbon\Carbon::now()->subHours(1)->format('Ymd\TH0000\Z') }}
UID:UNIQUE_UID@google.com
CREATED:{{ \Carbon\Carbon::now()->subHours(1)->format('Ymd\TH0000\Z') }}
DESCRIPTION:Event description
LAST-MODIFIED:{{ \Carbon\Carbon::now()->subHours(1)->format('Ymd\TH0000\Z') }}
LOCATION:Event location
SEQUENCE:2
STATUS:CONFIRMED
SUMMARY:Event title
TRANSP:OPAQUE
END:VEVENT
BEGIN:VEVENT
DTSTART:{{ \Carbon\Carbon::now()->subYear()->addHours(1)->format('Ymd\TH0000\Z') }}
DTEND:{{ \Carbon\Carbon::now()->subYear()->addHours(2)->format('Ymd\TH0000\Z') }}
DTSTAMP:{{ \Carbon\Carbon::now()->subYear()->subHours(1)->format('Ymd\TH0000\Z') }}
UID:UNIQUE_UID@google.com
CREATED:{{ \Carbon\Carbon::now()->subYear()->subHours(1)->format('Ymd\TH0000\Z') }}
DESCRIPTION:Event description
LAST-MODIFIED:{{ \Carbon\Carbon::now()->subYear()->subHours(1)->format('Ymd\TH0000\Z') }}
LOCATION:Event location
SEQUENCE:2
STATUS:CONFIRMED
SUMMARY:Event title
TRANSP:OPAQUE
END:VEVENT
BEGIN:VEVENT
DTSTART:{{ \Carbon\Carbon::now()->addYear()->addHours(1)->format('Ymd\TH0000\Z') }}
DTEND:{{ \Carbon\Carbon::now()->addYear()->addHours(2)->format('Ymd\TH0000\Z') }}
DTSTAMP:{{ \Carbon\Carbon::now()->addYear()->subHours(1)->format('Ymd\TH0000\Z') }}
UID:UNIQUE_UID@google.com
CREATED:{{ \Carbon\Carbon::now()->addYear()->subHours(1)->format('Ymd\TH0000\Z') }}
DESCRIPTION:Event description
LAST-MODIFIED:{{ \Carbon\Carbon::now()->addYear()->subHours(1)->format('Ymd\TH0000\Z') }}
LOCATION:Event location
SEQUENCE:2
STATUS:CONFIRMED
SUMMARY:Event title
TRANSP:OPAQUE
END:VEVENT
END:VCALENDAR