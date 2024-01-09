import React, { useState, useEffect } from 'react';
import { LineChart, Line, XAxis, YAxis, Tooltip, Legend } from 'recharts';

const App = () => {
  const [data, setData] = useState([]);
  const [timeRange, setTimeRange] = useState('7'); // Default: last 7 days

  useEffect(() => {
    const fetchData = async () => {
      const response = await fetch(`/wp-json/dashboardwidget/v1/data?range=${timeRange}`);
      const result = await response.json();
      setData(result);
    };

    fetchData();
  }, [timeRange]);

  const handleTimeRangeChange = (event) => {
    setTimeRange(event.target.value);
  };

  return (
    <div>
      <select value={timeRange} onChange={handleTimeRangeChange}>
        <option value="7">Last 7 days</option>
        <option value="15">Last 15 days</option>
        <option value="30">Last 30 days</option>
      </select>

      <LineChart width={600} height={300} data={data}>
        <XAxis dataKey="date" />
        <YAxis />
        <Tooltip />
        <Legend />
        <Line type="monotone" dataKey="value" stroke="#8884d8" />
      </LineChart>
      
    </div>
  );
};

export default App;