'use client';

import { useEffect, useState } from 'react';
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';

type Event = {
  id: number;
  title: string;
  description: string;
  date: string; 
  time: string; 
  location: string;
};

const colors = [
  'bg-red-300',
  'bg-green-300',
  'bg-blue-300',
  'bg-yellow-300',
  'bg-purple-300',
  'bg-pink-300',
  'bg-indigo-300',
];

function getRandomColor(): string {
  return colors[Math.floor(Math.random() * colors.length)];
}

export default function EventsPage() {
  const [filter, setFilter] = useState<'today' | 'past' | 'future'>('today');
  const [events, setEvents] = useState<Event[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    setLoading(true);
    fetch(`${process.env.NEXT_PUBLIC_API_URL}/events?filter=${filter}`)
      .then(res => res.json())
      .then(data => {
        setEvents(data);
        setLoading(false);
      });
  }, [filter]);

function formatDate(dateStr: string): string {
  const date = new Date(dateStr);
  const day = String(date.getDate()).padStart(2, '0');
  const month = String(date.getMonth() + 1).padStart(2, '0');
  const year = date.getFullYear();
  return `${day}/${month}/${year}`;
}


  return (
    <div className="p-6 space-y-4">
      <div className="flex gap-2">
        {['today', 'past', 'future'].map(f => (
          <Button
            key={f}
            variant={filter === f ? 'default' : 'outline'}
            onClick={() => setFilter(f as any)}
          >
            {f.charAt(0).toUpperCase() + f.slice(1)}
          </Button>
        ))}
      </div>

      {loading ? (
        <p>Loading...</p>
      ) : events.length === 0 ? (
        <p>No events found.</p>
      ) : (
        <div className="grid gap-4 sm:grid-cols-2 md:grid-cols-3">
          {events.map(event => (
            <Card key={event.id} className="overflow-hidden">
              <div className={`h-32 ${getRandomColor()} w-full`} />
              <CardContent className="p-4 space-y-2">
                <h2 className="text-xl font-semibold">{event.title}</h2>
                <p className="text-sm text-gray-600">{event.description}</p>
                <div className="text-sm text-gray-500">
                  📅 {formatDate(event.date)} <br />
                  ⏰ {event.time} <br />
                  📍 {event.location}
                </div>
              </CardContent>
            </Card>
          ))}
        </div>
      )}
    </div>
  );
}
