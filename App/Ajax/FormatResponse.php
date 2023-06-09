<?php
/**
 * Description: Format Response data.
 *
 * @since 1.0.0
 */

namespace Ddev\Ajax;

class FormatResponse {

	/**
	 * Data list getting from database.
	 *
	 * @since 1.0.0
	 * @var mixed
	 */
	private mixed $data;

	public function __construct( $data ) {
		$this->data = json_decode( $data );
	}

	/**
	 * Make table data return.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	public function build_table_data(): array {
		$table_data = [];
		$table = $this->data->table;

		$table_data['title']   = $table->title;
		$table_data['headers'] = $table->data->headers;
		$table_data['rows']    = $table->data->rows;
		return $table_data;
	}
	/**
	 * Make Graph data return.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	public function build_graph_data(): array {
		$char_values = [];
		$graph_data  = $this->data->graph;

		if ( $graph_data ) {
			foreach ( $graph_data as $item ) {
				$char_values[] = array(
					'x' => $item->date,
					'y' => $item->value
				);
			}
		}
		return $char_values;
	}
}