import type { WeeklyPlanning } from '../types/WeeklyPlanning';

const API_BASE = '/api/weekly-plannings';

async function parseResponse<T>(response: Response): Promise<T> {
  if (!response.ok) {
    const errorText = await response.text();
    throw new Error(errorText || 'Erro ao se comunicar com a API.');
  }

  if (response.status === 204) {
    return Promise.resolve(undefined as unknown as T);
  }

  return response.json();
}

export async function listWeeklyPlannings(): Promise<WeeklyPlanning[]> {
  const response = await fetch(API_BASE, {
    headers: {
      Accept: 'application/json',
    },
  });

  return parseResponse<WeeklyPlanning[]>(response);
}

export async function loadWeeklyPlanning(id: number): Promise<WeeklyPlanning> {
  const response = await fetch(`${API_BASE}/${id}`, {
    headers: {
      Accept: 'application/json',
    },
  });

  return parseResponse<WeeklyPlanning>(response);
}

export async function saveWeeklyPlanning(planning: WeeklyPlanning): Promise<WeeklyPlanning> {
  const method = planning.id ? 'PUT' : 'POST';
  const url = planning.id ? `${API_BASE}/${planning.id}` : API_BASE;

  const response = await fetch(url, {
    method,
    headers: {
      'Content-Type': 'application/json',
      Accept: 'application/json',
    },
    body: JSON.stringify(planning),
  });

  return parseResponse<WeeklyPlanning>(response);
}

export async function deleteWeeklyPlanning(id: number): Promise<void> {
  const response = await fetch(`${API_BASE}/${id}`, {
    method: 'DELETE',
    headers: {
      Accept: 'application/json',
    },
  });

  await parseResponse<void>(response);
}
