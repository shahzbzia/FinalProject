module.exports = {
  theme: {
    extend: {
    	spacing: {
	        '72': '18rem',
	        '84': '21rem',
          '96': '24rem',
          '108': '27rem',
          '120': '30rem',
          '132': '33rem',
          '144': '36rem',
          '156': '39rem',
          '168': '42rem',
          '180': '45rem',
	        '192': '48rem',
    	},

    	width: {
	        '1/7': '14.2857143%',
	        '2/7': '28.5714286%',
	        '3/7': '42.8571429%',
	        '4/7': '57.1428571%',
	        '5/7': '71.4285714%',
	        '6/7': '85.7142857%',
  		},
  	}
  },
  variants: {
  	backgroundColor: ['responsive', 'hover', 'focus', 'active'],
  	textColor: ['responsive', 'hover', 'focus', 'active'],
  	rotate: ['responsive', 'hover', 'focus', 'active'],
  },
  plugins: [],
}
