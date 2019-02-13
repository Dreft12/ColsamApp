module.exports = {
  pages: {
    index: {
      entry: 'src/main.js', //entry for the public page
      template: 'public/index.html', // source template
      filename: 'index.html' // output as dist/*
    },
    student: {
      entry: 'src/student/main.js',
      template: 'public/student.html',
      filename: 'student.html'
    },
    teacher: {
      entry: 'src/teacher/main.js',
      template: 'public/teachers.html',
      filename: 'teachers.html'
    }
  },
  devServer: {
    historyApiFallback: {
      rewrites: [
        { from: /\/index/, to: '/index.html' },
        { from: /\/student/, to: '/student.html' },
        { from: /\/teachers/, to: '/teachers.html' }
      ]
    }
  }
}