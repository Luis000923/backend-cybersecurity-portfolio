export function getProjects() {
  // Return a small set of project metadata suitable for a low-resource environment.
  return [
    {
      id: 'proj-1',
      title: 'API Segura para Finanzas',
      description: 'Diseño de API con autenticación reforzada, logging y auditoría.',
      tags: ['api', 'auth', 'audit'],
      url: '#',
    },
    {
      id: 'proj-2',
      title: 'Plataforma de Telemetría',
      description: 'Ingesta en tiempo real con observabilidad y alertas.',
      tags: ['telemetry', 'observability'],
      url: '#',
    },
  ];
}
