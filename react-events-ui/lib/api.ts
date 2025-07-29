export async function fetchEvents(filter: 'today' | 'past' | 'future') {
  const res = await fetch(`${process.env.NEXT_PUBLIC_API_URL}/events?filter=${filter}`);
  if (!res.ok) throw new Error('Failed to fetch events');
  return res.json();
}
