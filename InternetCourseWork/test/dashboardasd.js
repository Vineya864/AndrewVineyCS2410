describe('Dashboard',function(){
	const test_data = [
	{bmi:28.71,date:'2010-01-01',injured:false,time:1544.66},
	{bmi:28.71,date:'2010-01-01',injured:false,time:1544.66},
	{bmi:27.86,date:'2010-01-24',injured:true},
	{bmi:28.03,date:'2010-01-29',injured:false,time:1400.13},
	{bmi:27.71,date:'2010-01-31',injured:false,time:1419.09},
	{bmi:27.51,date:'2010-02-07',injured:false,time:1466.51},
	{bmi:27.57,date:'2010-02-13',injured:false,time:1468.64}
];

		describe('remove_incomplete_run',function(){
			it('removes incomplete runs from its inputs',function(){
				
			var complete_runs=remove_incomplete_run(test_data);
			expect(complete_runs).to.deep.equal([
			{bmi:28.71,date:'2010-01-01',injured:false,time:1544.66},
			{bmi:28.71,date:'2010-01-01',injured:false,time:1544.66},
			{bmi:28.03,date:'2010-01-29',injured:false,time:1400.13},
			{bmi:27.71,date:'2010-01-31',injured:false,time:1419.09},
			{bmi:27.51,date:'2010-02-07',injured:false,time:1466.51},
			{bmi:27.57,date:'2010-02-13',injured:false,time:1468.64}
			
			]);
		});
		
	});



	
		describe('run_by_date',function(){
			it('returns plots from data x runs y times',function(){
			var runs_by_date=run_by_date(test_data);
				expect(runs_by_date).to.deep.equal({
				x:['2010-01-01','2010-01-01','2010-01-29','2010-01-31',
					'2010-02-07','2010-02-13'],
				y:[1544.66,1544.66,1400.13,1419.09,1466.51,1468.64
			   ]
      });
    });
  });;	
  
	
	
   describe('Injuries by Recent Runs',function(){
     describe('recent_Runs',function(){
      it('counts the number of runs in the 28 days before each of the runs ' +
      ' in its input array',function(){
        var recent_run_count = recent_Runs(test_data);
        expect(recent_run_count).to.deep.equal([0,1,2,3,2,3,0]);
      });
    });

    describe('calculate_injury_probability_by_recent_run_number',function(){
      it('returns plot data from its input, with x being a number of recent ' +
      'runs and y being the observer probability with which the runner is ' +
      'injured when attempting to run while having that number of recent runs.',
      function(){
        var injury_probability_by_effort =
          calculate_injury_probability_by_recent_run_number(test_data);
        expect(injury_probability_by_effort).to.deep.equal({
          x: [0,1,2,3],
          y: [0.5,0,0.5,0]
        });
      });
    });
  });
});
