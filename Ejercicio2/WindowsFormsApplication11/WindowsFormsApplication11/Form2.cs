using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Text;
using System.Windows.Forms;

namespace WindowsFormsApplication11
{
    public partial class Form2 : Form
    {
        // Declarar el objeto del servicio web a nivel de la clase
        ServiceReference1.WebService1SoapClient ws = new ServiceReference1.WebService1SoapClient();

        public Form2()
        {
            InitializeComponent();


                // Asociar el evento SelectionChanged al control DataGridView
                dataGridView1.SelectionChanged += dataGridView1_SelectionChanged;


        }

        private void Form2_Load(object sender, EventArgs e)
        {
            // Utilizar el objeto ws para obtener datos de alumnos
            dataGridView1.DataSource = ws.Alumno().Tables[0];
        }

        private void dataGridView1_CellContentClick(object sender, DataGridViewCellEventArgs e)
        {
            // Manejar eventos de celda si es necesario
        }
        private void dataGridView1_SelectionChanged(object sender, EventArgs e)
        {
            // Manejar el evento de cambio de selección en el DataGridView
            if (dataGridView1.SelectedRows.Count > 0)
            {
                // Obtener índices de columnas
                int colNombre = dataGridView1.Columns["Nombre"].Index;
                int colPaterno = dataGridView1.Columns["Paterno"].Index;
                int colMaterno = dataGridView1.Columns["Materno"].Index;
                int colTelefono = dataGridView1.Columns["Telefono"].Index;

                // Obtener datos del alumno seleccionado y mostrarlos en los TextBox
                txtNombre.Text = dataGridView1.SelectedRows[0].Cells[colNombre].Value.ToString();
                txtPaterno.Text = dataGridView1.SelectedRows[0].Cells[colPaterno].Value.ToString();
                txtMaterno.Text = dataGridView1.SelectedRows[0].Cells[colMaterno].Value.ToString();
                txtTelefono.Text = dataGridView1.SelectedRows[0].Cells[colTelefono].Value.ToString();
            }
        }
        private void button1_Click(object sender, EventArgs e)
        {
            // Obtener datos de los TextBox
            string nuevoNombre = txtNombre.Text;
            string nuevoPaterno = txtPaterno.Text;
            string nuevoMaterno = txtMaterno.Text;
            string nuevoTelefono = txtTelefono.Text;

            // Llamamos al servicio web para agregar un nuevo alumno
            ws.AgregarAlumno(nuevoNombre, nuevoPaterno, nuevoMaterno, nuevoTelefono);

            // Actualizamos el DataGridView
            RefreshDataGridView();
        }
        private void button2_Click(object sender, EventArgs e)
        {
            // Verificamos si hay una fila seleccionada
            if (dataGridView1.SelectedRows.Count > 0)
            {
                // Obtenemos el ID del alumno seleccionado
                int idAlumno = Convert.ToInt32(dataGridView1.SelectedRows[0].Cells["NewID"].Value);

                // Llamamos al servicio web para eliminar al alumno
                ws.EliminarAlumno(idAlumno);

                // Actualizamos el DataGridView
                RefreshDataGridView();
            }
            else
            {
                MessageBox.Show("Seleccione un alumno para eliminar.");
            }
        }

        private void button3_Click(object sender, EventArgs e)
        {
            // Verificamos si hay una fila seleccionada
            if (dataGridView1.SelectedRows.Count > 0)
            {
                // Obtener datos del alumno seleccionado en el DataGridView
                int idAlumno = Convert.ToInt32(dataGridView1.SelectedRows[0].Cells["NewID"].Value);
                string nuevoNombre = txtNombre.Text;
                string nuevoPaterno = txtPaterno.Text;
                string nuevoMaterno = txtMaterno.Text;
                string nuevoTelefono = txtTelefono.Text;

                // Llamamos al servicio web para cambiar los datos del alumno seleccionado
                ws.CambiarAlumno(idAlumno, nuevoNombre, nuevoPaterno, nuevoMaterno, nuevoTelefono);

                // Actualizamos el DataGridView
                RefreshDataGridView();
            }
            else
            {
                MessageBox.Show("Seleccione un alumno para cambiar.");
            }
        }
       


        private void RefreshDataGridView()
        {
            // Actualiza el DataGridView con los datos más recientes del servicio web
            dataGridView1.DataSource = ws.Alumno().Tables[0];
        }
    }
}
